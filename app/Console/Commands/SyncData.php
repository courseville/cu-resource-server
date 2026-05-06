<?php

namespace App\Console\Commands;

use App\Models\DataSource;
use App\Models\FailedImportRow;
use App\Models\Import;
use App\Models\PkModel;
use App\Transformers\DataTransformer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from sources and sync to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::disableQueryLog();

        // 1. Iterate over active DataSource and transform/sync data
        $sources = DataSource::where('is_active', true)->get();

        foreach ($sources as $source) {
            $this->info("Processing data source: {$source->name} (Type: {$source->type}, URL: {$source->url})");

            switch ($source->type) {
                case 'file':
                    $filePath = $source->getFilePath();
                    if ($filePath && Str::endsWith(strtolower($filePath), '.csv')) {
                        $this->processCsvSource($source, $filePath);
                    } else {
                        $this->processGeneralSource($source);
                    }
                    break;

                case 'mysql':
                    $this->processMysqlSource($source);
                    break;

                default:
                    $this->error("Unknown data source type: {$source->type} for source '{$source->name}'");
            }
        }

        $this->info('Data sync completed.');
    }

    /**
     * Process general data source (fetch data, parse, and sync).
     */
    protected function processGeneralSource(DataSource $source)
    {
        $rawData = $source->getData();

        if (! $rawData) {
            $this->warn("No data found or failed to fetch from: {$source->url}");

            return;
        }

        $dataArray = $this->parseData($rawData, $source->url);

        if (empty($dataArray)) {
            $this->warn("Data is empty after parsing for source: {$source->name}");

            return;
        }

        // Start auditing
        $import = Import::create([
            'data_source_id' => $source->id,
            'file_name' => basename($source->url),
            'file_path' => $source->url,
            'importer' => static::class,
            'total_rows' => count($dataArray),
            'user_id' => optional(Auth::user())->id ?? 1, // Fallback to system user
        ]);

        $transformedData = DataTransformer::transformFromSource($source->id, $dataArray);

        $successfulRows = $this->insertAndSync($transformedData, $import);

        $import->update([
            'processed_rows' => count($dataArray),
            'successful_rows' => $successfulRows,
            'completed_at' => now(),
        ]);

        $source->update(['last_synced_at' => now()]);
    }

    /**
     * Process CSV data source by streaming.
     */
    protected function processCsvSource(DataSource $source, string $filePath)
    {
        if (! ($handle = fopen($filePath, 'r'))) {
            $this->error("Failed to open file: {$filePath}");

            return;
        }

        $header = fgetcsv($handle);
        if (! $header) {
            $this->warn("Empty CSV or missing header: {$filePath}");
            fclose($handle);

            return;
        }

        // Count total rows without loading everything (still takes some time but saves memory)
        $totalRows = 0;
        while (! feof($handle)) {
            if (fgets($handle)) {
                $totalRows++;
            }
        }
        rewind($handle);
        fgetcsv($handle); // Skip header again

        $import = Import::create([
            'data_source_id' => $source->id,
            'file_name' => basename($source->url),
            'file_path' => $source->url,
            'importer' => static::class,
            'total_rows' => $totalRows,
            'user_id' => optional(Auth::user())->id ?? 1,
        ]);

        $successfulRows = 0;
        $mappings = DataTransformer::getMappings($source->id);

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) !== count($header)) {
                continue;
            }

            $item = array_combine($header, $row);

            foreach ($mappings as $model => $mapping) {
                if (! class_exists($model)) {
                    continue;
                }

                try {
                    $transformedItem = DataTransformer::transform($item, new $model, $mapping, $source->id);
                    if ($this->syncModelItem($model, $transformedItem, $item, $import)) {
                        $successfulRows++;
                    }
                } catch (\Exception $e) {
                    $this->error("Failed to transform {$model} item: ".$e->getMessage());
                }
            }
        }

        fclose($handle);

        $import->update([
            'processed_rows' => $totalRows,
            'successful_rows' => $successfulRows,
            'completed_at' => now(),
        ]);

        $source->update(['last_synced_at' => now()]);
    }

    /**
     * Parse raw data (CSV or JSON) into an array.
     */
    protected function parseData(string $rawData, string $url): array
    {
        // Simple CSV parsing if file ends with .csv
        if (Str::endsWith(strtolower($url), '.csv')) {
            $rows = array_map('str_getcsv', explode("\n", trim($rawData)));
            $header = array_shift($rows);
            $data = [];

            foreach ($rows as $row) {
                if (count($row) === count($header)) {
                    $data[] = array_combine($header, $row);
                }
            }

            return $data;
        }

        // Simple JSON parsing if file ends with .json
        if (Str::endsWith(strtolower($url), '.json')) {
            return json_decode($rawData, true) ?? [];
        }

        return [];
    }

    /**
     * Generic insert logic (inspired by SyncDataMock2)
     */
    protected function insertAndSync(array $transformedData, Import $import): int
    {
        $successfulRows = 0;

        foreach ($transformedData as $model => $data) {
            if (class_exists($model)) {
                foreach ($data as $item) {
                    if ($this->syncModelItem($model, $item, $item, $import)) {
                        $successfulRows++;
                    }
                }
            } else {
                $this->error("Model {$model} does not exist.");
            }
        }

        return $successfulRows;
    }

    /**
     * Process MySQL data source by fetching from remote database.
     *
     * URL format: connection_name:table_name
     * Example: pi:remote_table
     * The connection_name must be defined in config/database.php
     */
    protected function processMysqlSource(DataSource $source)
    {
        $parts = explode(':', $source->url, 3);

        if (count($parts) < 2) {
            $this->error("Invalid MySQL URL format for source: {$source->name}. Expected: connection_name:table_name[:order_by_column]");

            return;
        }

        $connectionName = $parts[0];
        $tableName = $parts[1];
        $orderBy = $parts[2] ?? 'id';

        try {
            $this->info("Connecting to remote MySQL (Connection: {$connectionName}, Table: {$tableName}, OrderBy: {$orderBy})...");

            $query = DB::connection($connectionName)->table($tableName);
            $totalRows = $query->count();

            if ($totalRows === 0) {
                $this->warn("No data found in remote table: {$tableName}");

                return;
            }

            $import = Import::create([
                'data_source_id' => $source->id,
                'file_name' => "mysql:{$connectionName}.{$tableName}",
                'file_path' => $source->url,
                'importer' => static::class,
                'total_rows' => $totalRows,
                'user_id' => optional(Auth::user())->id ?? 1,
            ]);

            $successfulRows = 0;
            $mappings = DataTransformer::getMappings($source->id);

            $query->orderBy($orderBy)->chunk(500, function ($rows) use ($source, $import, $mappings, &$successfulRows) {
                foreach ($rows as $row) {
                    $item = (array) $row;
                    foreach ($mappings as $model => $mapping) {
                        if (! class_exists($model)) {
                            continue;
                        }

                        try {
                            $transformedItem = DataTransformer::transform($item, new $model, $mapping, $source->id);
                            if ($this->syncModelItem($model, $transformedItem, $item, $import)) {
                                $successfulRows++;
                            }
                        } catch (\Exception $e) {
                            $this->error("Transformation failed for {$model}: ".$e->getMessage());
                        }
                    }
                }
            });

            $import->update([
                'processed_rows' => $totalRows,
                'successful_rows' => $successfulRows,
                'completed_at' => now(),
            ]);

            $source->update(['last_synced_at' => now()]);
            $this->info("MySQL sync completed: {$successfulRows} rows successfully synced.");

        } catch (\Exception $e) {
            $this->error("Failed to sync from MySQL source '{$source->name}': ".$e->getMessage());
        } finally {
            // No explicit disconnect required for pre-defined connections,
            // but we can disconnect if needed for long-running processes.
            // DB::disconnect($connectionName);
        }
    }

    /**
     * Synchronize a specific model item with the database.
     */
    protected function syncModelItem(string $model, array $transformedItem, array $originalItem, Import $import): bool
    {
        if (! class_exists($model)) {
            $this->error("Model {$model} does not exist.");

            return false;
        }

        try {
            $modelPk = PkModel::where('model', '=', $model)->first();
            $pkString = $modelPk ? $modelPk->primary_key : 'id';
            $pks = explode(',', $pkString);
            $search = [];

            foreach ($pks as $pk) {
                $pk = trim($pk);
                if (! isset($transformedItem[$pk])) {
                    throw new \Exception("Missing primary key '{$pk}' for model {$model}.");
                }
                $search[$pk] = $transformedItem[$pk];
            }

            $model::updateOrCreate($search, $transformedItem);
            // $this->info("Synced {$model} item: ".implode(', ', $search));
            // $this->info('Transformed item: '.implode(', ', $transformedItem));

            return true;
        } catch (\Exception $e) {
            $this->error("Failed to sync {$model} item: ".$e->getMessage());

            FailedImportRow::create([
                'import_id' => $import->id,
                'data' => $originalItem,
                'validation_error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
