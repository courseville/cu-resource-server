<?php

namespace App\Console\Commands;

use App\Models\DataSource;
use App\Models\TestUser;
use App\Models\TestProfile;
use App\Transformers\DataTransformer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncDataMock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-data-mock';

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
        // Define required fields
        $userRequiredFields = ['name', 'email', 'created_at', 'password'];
        $profileRequiredFields = ['test_user_id', 'bio', 'avatar'];

        $source1Data = [
            [
                'id' => '5',
                'full_name' => 'John Does',
                'email_address' => 'john.doe@example.com',
                'password' => '123456',
                'registration_date' => '2025-01-01 12:00:00',
                'about_me' => 'A short about_me about Johnnnn.',
                'profile_picture' => 'john_profile_picture.jpg',
            ],
            [
                'id' => '6',
                'full_name' => 'Alice Johnson',
                'email_address' => 'alice.johnson@example.com',
                'password' => '123456',
                'registration_date' => '2025-02-10 15:30:00',
                'about_me' => 'Passionate about tech and programming.',
                'profile_picture' => 'alice_profile_picture.jpg',
            ],
            [
                'id' => '7',
                'full_name' => 'Bob Smith',
                'email_address' => 'bob.smith@example.com',
                'password' => '123456',
                'registration_date' => '2025-03-25 09:00:00',
                'about_me' => 'Loves hiking and outdoor adventures.',
                'profile_picture' => 'bob_profile_picture.jpg',
            ]
        ];

        $source1Id = DataSource::where("name", "=", "source1")->value('id');

        $formattedData1 = DataTransformer::transformFromSource($source1Id, $source1Data);

        $userIds = [];
        if (isset($formattedData1['App\\Models\\TestUser'])) {
            foreach ($formattedData1['App\\Models\\TestUser'] as $userData) {
                $missing = collect($userRequiredFields)->filter(fn($field) => empty($userData[$field]));
                if ($missing->isNotEmpty()) {
                    $this->warn("Skipping user, missing required fields: " . $missing->implode(', '));
                    continue;
                }

                $user = TestUser::updateOrCreate(
                    ['data_source_id' => $source1Id, 'data_id' => $userData['data_id']],
                    [
                        'email' => $userData['email'],
                        'name' => $userData['name'],
                        'password' => $userData['password'],
                        'created_at' => $userData['created_at'],
                    ]
                );


                $userIds[$userData['data_id']] = $user->id;

                $this->info("Inserted user: " . json_encode($userData));
            }
        }


        if (isset($formattedData1['App\\Models\\TestProfile'])) {
            foreach ($formattedData1['App\\Models\\TestProfile'] as $profileData) {
                $sourceUserId = $profileData['data_id'];
                $realUserId = $userIds[$sourceUserId] ?? null;

                if (!$realUserId) {
                    $this->warn("Skipping profile, user not found for source user_id: $sourceUserId");
                    continue;
                }

                $profileData['test_user_id'] = $realUserId;

                $missing = collect($profileRequiredFields)->filter(fn($field) => empty($profileData[$field]));
                if ($missing->isNotEmpty()) {
                    $this->warn("Skipping profile, missing required fields: " . $missing->implode(', '));
                    continue;
                }

                $profile = TestProfile::updateOrCreate(
                    ['data_source_id' => $source1Id, 'data_id' => $profileData['data_id']],
                    [
                        'test_user_id' => $profileData['test_user_id'],
                        'bio' => $profileData['bio'],
                        'avatar' => $profileData['avatar'],
                    ]
                );

                $this->info("Inserted profile for user_id {$profile}");
            }
        }
    }
}
