<?php

namespace App\Console\Commands;

use App\Models\DataSource;
use App\Models\User;
use App\Models\Profile;
use App\Transformers\DataTransformer;
use Illuminate\Console\Command;

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
        $profileRequiredFields = ['user_id', 'bio', 'avatar'];

        $source1Data = [
            [
                'id' => '5',
                'full_name' => 'John Doe',
                'email_address' => 'john.doe@example.com',
                'registration_date' => '2025-01-01 12:00:00',
                'about_me' => 'A short about_me about John.',
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
        $emailToSourceId = collect($source1Data)->pluck('id', 'email_address')->toArray();

        $userIds = [];
        if (isset($formattedData1['App\\Models\\User'])) {
            foreach ($formattedData1['App\\Models\\User'] as $userData) {
                $missing = collect($userRequiredFields)->filter(fn($field) => empty($userData[$field]));
                if ($missing->isNotEmpty()) {
                    $this->warn("Skipping user, missing required fields: " . $missing->implode(', '));
                    continue;
                }

                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => $userData['password'],
                    'created_at' => $userData['created_at'],
                ]);

                $sourceId = $emailToSourceId[$userData['email']] ?? null;
                if ($sourceId) {
                    $userIds[$sourceId] = $user->id;
                }

                $this->info("Inserted user: " . json_encode($userData));
            }
        }


        if (isset($formattedData1['App\\Models\\Profile'])) {
            foreach ($formattedData1['App\\Models\\Profile'] as $profileData) {
                $sourceUserId = $profileData['user_id'];
                $realUserId = $userIds[$sourceUserId] ?? null;

                if (!$realUserId) {
                    $this->warn("Skipping profile, user not found for source user_id: $sourceUserId");
                    continue;
                }

                $profileData['user_id'] = $realUserId;

                $missing = collect($profileRequiredFields)->filter(fn($field) => empty($profileData[$field]));
                if ($missing->isNotEmpty()) {
                    $this->warn("Skipping profile, missing required fields: " . $missing->implode(', '));
                    continue;
                }

                Profile::create([
                    'user_id' => $profileData['user_id'],
                    'bio' => $profileData['bio'],
                    'avatar' => $profileData['avatar'],
                ]);

                $this->info("Inserted profile for user_id {$realUserId}");
            }
        }

    }
}
