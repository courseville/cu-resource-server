<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Preset OAuth Clients
        $clients = [
            // 1. Authorization Code Grant
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Auth Code Client',
                'secret' => bcrypt('auth-secret'),
                'redirect' => 'https://example.com/callback',
                'personal_access_client' => false,
                'password_client' => false,
                'revoked' => false,
                'user_id' => 1, // Assuming user with ID 1 (replace with actual user_id)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 2. Client Credentials Grant - Needs User Data
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Client with User Data',
                'secret' => bcrypt('client-secret-1'),
                'redirect' => 'https://example.com/callback',  // This could be unused for client credentials, but kept for consistency
                'personal_access_client' => false,
                'password_client' => false,
                'revoked' => false,
                'user_id' => null, // No user association needed for this type
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 3. Client Credentials Grant - No User Data
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Client without User Data',
                'secret' => bcrypt('client-secret-2'),
                'redirect' => 'https://example2.com/callback', // Unused for this grant type
                'personal_access_client' => false,
                'password_client' => false,
                'revoked' => false,
                'user_id' => null, // No user association needed for this type
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 4. Mixed Client (Authorization Code + Client Credentials)
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Mixed Client',
                'secret' => bcrypt('mixed-client-secret'),
                'redirect' => 'https://example3.com/callback', // Used for auth code flow
                'personal_access_client' => false,
                'password_client' => true,  // The client can also use client credentials grant for non-user data
                'revoked' => false,
                'user_id' => 3, // Assuming user with ID 3
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert OAuth Clients
        DB::table('oauth_clients')->insert($clients);

    }
}
