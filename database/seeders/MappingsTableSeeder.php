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
        $source1Id = DB::table('data_sources')->insertGetId([
            'name' => 'source1',
            'url' => 'https://source1.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $source2Id = DB::table('data_sources')->insertGetId([
            'name' => 'source2',
            'url' => 'https://source2.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $source3Id = DB::table('data_sources')->insertGetId([
            'name' => 'source3',
            'url' => 'https://source3.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('transformer_mappings')->insert([
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\User',
                'field' => 'name',
                'mapping' => 'full_name',
                'formatting' => json_encode(['trim', 'uppercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\User',
                'field' => 'email',
                'mapping' => 'email_address',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\User',
                'field' => 'created_at',
                'mapping' => 'registration_date',
                'formatting' => json_encode(['date_format']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\User',
                'field' => 'password',
                'mapping' => 'password',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\Profile',
                'field' => 'user_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\Profile',
                'field' => 'bio',
                'mapping' => 'about_me',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\Profile',
                'field' => 'avatar',
                'mapping' => 'profile_picture',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\User',
                'field' => 'name',
                'mapping' => 'username',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\User',
                'field' => 'email',
                'mapping' => 'contact_email',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\User',
                'field' => 'created_at',
                'mapping' => 'signup_date',
                'formatting' => json_encode(['date_format']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\Profile',
                'field' => 'bio',
                'mapping' => 'bio_info',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\Profile',
                'field' => 'avatar',
                'mapping' => 'image_url',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\Profile',
                'field' => 'user_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source3Id,
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
