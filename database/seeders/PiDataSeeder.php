<?php

namespace Database\Seeders;

use App\Models\DataSource;
use App\Models\TransformerMapping;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class PiDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * NOTE: This seeder requires a database connection named 'pi' to be configured 
         * in your config/database.php file. This connection is used as the remote 
         * source for the MySQL data sync process.
         */

        $dgMappings = [
            'PI regcode' => [
                'url' => 'pi:mx_student_regcode',
                'model' => \App\Models\Resources\Student::class,
                'fields' => [
                    'student_id' => 'student_id',
                    'reg_code' => 'reg_code',
                ],
            ],
        ];

        DB::transaction(function () use ($dgMappings) {
            foreach ($dgMappings as $name => $configs) {
                // 1. Create or update the DataSource
                $dataSource = DataSource::updateOrCreate(
                    ['name' => $name],
                    ['url' => $configs['url'], 'type' => 'mysql']
                );

                // Determine if it's a single configuration or multiple
                $configList = (isset($configs['model'])) ? [$configs] : $configs;

                foreach ($configList as $config) {
                    // 2. Update PkModel for this resource
                    // Use explicit 'pks' if defined, otherwise fallback to the first field
                    $pkField = $config['pks'] ?? array_key_first($config['fields']);
                    \App\Models\PkModel::updateOrCreate(
                        ['model' => $config['model']],
                        ['primary_key' => $pkField]
                    );

                    // 3. Update Transformer Mappings
                    $sourceId = $dataSource->id;
                    $modelClass = $config['model'];
                    $currentFields = array_keys($config['fields']);

                    // Delete any existing mappings for this model/source NOT in the seeder
                    TransformerMapping::where('data_source_id', $sourceId)
                        ->where('model', $modelClass)
                        ->whereNotIn('field', $currentFields)
                        ->delete();

                    // Update or create mappings from the seeder
                    foreach ($config['fields'] as $fillableField => $csvHeader) {
                        TransformerMapping::updateOrCreate(
                            [
                                'data_source_id' => $sourceId,
                                'model' => $modelClass,
                                'field' => $fillableField,
                            ],
                            [
                                'mapping' => $csvHeader,
                                'formatting' => json_encode([]),
                                'updated_at' => Carbon::now(),
                            ]
                        );
                    }

                    $this->command->info("Updated mappings for DataSource: {$name} (Model: {$modelClass})");
                }
            }
        });

        // // 4. Finally, trigger the background sync
        // $this->command->info('Mappings and data sources have been successfully seeded. Starting app:sync-data...');

        // $exitCode = Artisan::call('app:sync-data');

        // if ($exitCode === 0) {
        //     $this->command->info('app:sync-data executed successfully!');
        //     $this->command->line(Artisan::output());
        // } else {
        //     $this->command->error('app:sync-data encountered an error. Exit Code: '.$exitCode);
        //     $this->command->line(Artisan::output());
        // }
    }
}
