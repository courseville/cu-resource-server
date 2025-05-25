<?php

namespace App\Console\Commands;

use App\Models\DataSource;
use App\Models\PkModel;
use App\Transformers\DataTransformer;
use Illuminate\Console\Command;

class SyncDataMock2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-data-mock-2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $source4Data = [
            [
                'id' => '6431311921',
                'full_name' => 'John Doe',
                'email_address' => 'john.doe@example.com',
                'password' => '123456',
            ],
            [
                'id' => '6431311922',
                'full_name' => 'Alice Johnson',
                'email_address' => 'alice.johnson@example.com',
                'password' => '123456',
            ],
            [
                'id' => '6431311923',
                'full_name' => 'Bob Smith',
                'email_address' => 'bob.smith@example.com',
                'password' => '123456',
            ],
        ];

        $source5Data = [
            [
                'nisit_id' => '6431311921',
                'telephone' => '0879279575',
                'about_me' => 'A short about_me about Johnnnn.',
                'profile_picture' => 'john_profile_picture.jpg',
            ],
            [
                'nisit_id' => '6431311922',
                'telephone' => '0879279575',
                'about_me' => 'Passionate about tech and programming.',
                'profile_picture' => 'alice_profile_picture.jpg',
            ],
            [
                'nisit_id' => '6431311923',
                'telephone' => '0879279576',
                'about_me' => 'Loves hiking and outdoor adventures.',
                'profile_picture' => 'bob_profile_picture.jpg',
            ],
        ];

        $source4Id = DataSource::where('name', '=', 'source4')->value('id');
        $source5Id = DataSource::where('name', '=', 'source5')->value('id');

        $formattedData1 = DataTransformer::transformFromSource($source4Id, $source4Data);
        $formattedData2 = DataTransformer::transformFromSource($source5Id, $source5Data);

        $this->insert($formattedData1);
        $this->insert($formattedData2);
    }

    public function insert($datas)
    {
        foreach ($datas as $model => $data) {
            // Check if the model exists
            if (class_exists($model)) {
                foreach ($data as $item) {
                    $modelPk = PkModel::where('model', '=', $model)->first();
                    $modelInstance = $model::updateOrCreate([$modelPk['primary_key'] => $item[$modelPk['primary_key']]], $item);
                    $this->info("Inserted into {$model}: ".json_encode($item));
                    $this->info('primary_key: '.$modelPk['primary_key'].', '.$item[$modelPk['primary_key']]);
                }
            } else {
                $this->error("Model {$model} does not exist.");
            }
        }
    }
}
