<?php

namespace App\Console\Commands;

use App\Models\DataSource;
use App\Models\PkModel;
use App\Transformers\DataTransformer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
        // 1. Run the shell script to fetch CSV files via SFTP
        $this->info('Starting SFTP data fetch...');

        // Executing the bash command as provided by the user
        $bashCommand = "cd ~/dg-scripts && sshpass -f .dg_password sftp -o StrictHostKeyChecking=no -o LogLevel=ERROR sftp_mcv@161.200.194.183 <<< $'lcd dg/\nmget DG*.csv\nbye'";

        $this->info('Executing bash command...');
        exec($bashCommand, $output, $returnVar);

        if ($returnVar !== 0) {
            $this->error('SFTP fetch failed with exit code: '.$returnVar);
            $this->error(implode("\n", $output));

            return 1;
        }

        $this->info('SFTP fetch completed successfully.');
        $this->info('===================================');

        // 2. Iterate over DataSource and transform/sync data
        $sources = DataSource::all();

        foreach ($sources as $source) {
            $this->info("Processing data source: {$source->name} (URL: {$source->url})");

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

            $transformedData = DataTransformer::transformFromSource($source->id, $dataArray);
            $this->insertAndSync($transformedData);
        }

        $this->info('Data sync completed.');
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
    protected function insertAndSync(array $transformedData)
    {
        foreach ($transformedData as $model => $data) {
            if (class_exists($model)) {
                $modelPk = PkModel::where('model', '=', $model)->first();
                $pk = $modelPk ? $modelPk->primary_key : 'id';

                foreach ($data as $item) {
                    if (! isset($item[$pk])) {
                        $this->warn("Missing primary key '{$pk}' for model {$model}. Skipping item.");

                        continue;
                    }

                    $model::updateOrCreate([$pk => $item[$pk]], $item);
                    $this->info("Synced {$model} item: ".($item[$pk] ?? 'N/A'));
                }
            } else {
                $this->error("Model {$model} does not exist.");
            }
        }
    }
}
