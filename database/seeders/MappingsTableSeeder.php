<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MappingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transformer_mappings')->insert([
            [
                'source' => 'source1',
                'model' => 'App\Models\User',
                'field' => 'name',
                'mapping' => 'full_name',
                'formatting' => json_encode(['trim', 'uppercase']), // Apply trim and uppercase formatting
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source1',
                'model' => 'App\Models\User',
                'field' => 'email',
                'mapping' => 'email_address',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source1',
                'model' => 'App\Models\User',
                'field' => 'created_at',
                'mapping' => 'registration_date',
                'formatting' => json_encode(['date_format']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source1',
                'model' => 'App\Models\Profile',
                'field' => 'user_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source1',
                'model' => 'App\Models\Profile',
                'field' => 'bio',
                'mapping' => 'about_me',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source1',
                'model' => 'App\Models\Profile',
                'field' => 'avatar',
                'mapping' => 'profile_picture',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'source' => 'source2',
                'model' => 'App\Models\User',
                'field' => 'name',
                'mapping' => 'username',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source2',
                'model' => 'App\Models\User',
                'field' => 'email',
                'mapping' => 'contact_email',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source2',
                'model' => 'App\Models\User',
                'field' => 'created_at',
                'mapping' => 'signup_date',
                'formatting' => json_encode(['date_format']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source2',
                'model' => 'App\Models\Profile',
                'field' => 'bio',
                'mapping' => 'bio_info',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source2',
                'model' => 'App\Models\Profile',
                'field' => 'avatar',
                'mapping' => 'image_url',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source2',
                'model' => 'App\Models\Profile',
                'field' => 'user_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source' => 'source3',
                'model' => 'App\Models\Profile',
                'field' => 'user_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
