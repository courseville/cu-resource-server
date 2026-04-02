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

        // 1. Run the shell script to fetch CSV files via SFTP
        $this->info('Starting SFTP data fetch...');

        if (app()->environment('testing', 'local')) {
            $this->info('Skipping SFTP fetch in testing or local environment.');
        } else {
            // Executing the bash command as provided by the user
            $bashCommand = "cd ~/dg-scripts && sshpass -f .dg_password sftp -o StrictHostKeyChecking=no -o LogLevel=ERROR sftp_mcv@161.200.194.183 <<< $'lcd dg/\nmget DG*.csv\nbye'";

            $this->info('Executing bash command...');
            exec($bashCommand, $output, $returnVar);

            if ($returnVar !== 0) {
                $this->error('SFTP fetch failed with exit code: '.$returnVar);
                $this->error(implode("\n", $output));

                return 1;
            }
        }

        $this->info('SFTP fetch completed successfully.');
        $this->info('===================================');

        // 2. Iterate over DataSource and transform/sync data
        $sources = DataSource::all();

        foreach ($sources as $source) {
            $this->info("Processing data source: {$source->name} (URL: {$source->url})");

            $filePath = $source->getFilePath();

            if ($filePath && Str::endsWith(strtolower($filePath), '.csv')) {
                $this->processCsvSource($source, $filePath);
            } else {
                $rawData = $source->getData();

                if (! $rawData) {
                    $this->warn("No data found or failed to fetch from: {$source->url}");

                    continue;
                }

                $dataArray = $this->parseData($rawData, $source->url);

                if (empty($dataArray)) {
                    $this->warn("Data is empty after parsing for source: {$source->name}");

                    continue;
                }

                // Start auditing
                $import = Import::create([
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
            }
        }

        $this->info('Data sync completed.');
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
                    $this->info("Synced {$model} item: ".implode(', ', $search));
                    $successfulRows++;
                } catch (\Exception $e) {
                    $this->error("Failed to sync {$model} item: ".$e->getMessage());

                    FailedImportRow::create([
                        'import_id' => $import->id,
                        'data' => $item,
                        'validation_error' => $e->getMessage(),
                    ]);
                }
            }
        }

        fclose($handle);

        $import->update([
            'processed_rows' => $totalRows,
            'successful_rows' => $successfulRows,
            'completed_at' => now(),
        ]);
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
                $modelPk = PkModel::where('model', '=', $model)->first();
                $pkString = $modelPk ? $modelPk->primary_key : 'id';
                $pks = explode(',', $pkString);

                foreach ($data as $item) {
                    try {
                        $search = [];
                        foreach ($pks as $pk) {
                            $pk = trim($pk);
                            if (! isset($item[$pk])) {
                                throw new \Exception("Missing primary key '{$pk}' for model {$model}.");
                            }
                            $search[$pk] = $item[$pk];
                        }

                        $model::updateOrCreate($search, $item);
                        $this->info("Synced {$model} item: ".implode(', ', $search));
                        $successfulRows++;
                    } catch (\Exception $e) {
                        $this->error("Failed to sync {$model} item: ".$e->getMessage());

                        FailedImportRow::create([
                            'import_id' => $import->id,
                            'data' => $item,
                            'validation_error' => $e->getMessage(),
                        ]);
                    }
                }
            } else {
                $this->error("Model {$model} does not exist.");
            }
        }

        return $successfulRows;
    }
}
