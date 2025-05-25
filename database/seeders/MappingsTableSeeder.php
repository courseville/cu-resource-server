<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
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

        $source4Id = DB::table('data_sources')->insertGetId([
            'name' => 'source4',
            'url' => 'https://source4.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $source5Id = DB::table('data_sources')->insertGetId([
            'name' => 'source5',
            'url' => 'https://source5.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('transformer_mappings')->insert([
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\TestUser',
                'field' => 'data_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\TestUser',
                'field' => 'name',
                'mapping' => 'full_name',
                'formatting' => json_encode(['trim', 'uppercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\TestUser',
                'field' => 'email',
                'mapping' => 'email_address',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\TestUser',
                'field' => 'created_at',
                'mapping' => 'registration_date',
                'formatting' => json_encode(['date_format']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\TestUser',
                'field' => 'password',
                'mapping' => 'password',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\TestProfile',
                'field' => 'data_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\TestProfile',
                'field' => 'bio',
                'mapping' => 'about_me',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source1Id,
                'model' => 'App\Models\TestProfile',
                'field' => 'avatar',
                'mapping' => 'profile_picture',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\TestUser',
                'field' => 'name',
                'mapping' => 'username',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\TestUser',
                'field' => 'email',
                'mapping' => 'contact_email',
                'formatting' => json_encode(['trim', 'lowercase', 'replace:example.com,mydomain.com']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\TestUser',
                'field' => 'created_at',
                'mapping' => 'signup_date',
                'formatting' => json_encode(['date_format']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\TestProfile',
                'field' => 'bio',
                'mapping' => 'bio_info',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\TestProfile',
                'field' => 'avatar',
                'mapping' => 'image_url',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source2Id,
                'model' => 'App\Models\TestProfile',
                'field' => 'user_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source3Id,
                'model' => 'App\Models\TestProfile',
                'field' => 'user_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source4Id,
                'model' => 'App\Models\TestNisit',
                'field' => 'student_id',
                'mapping' => 'id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source4Id,
                'model' => 'App\Models\TestNisit',
                'field' => 'name',
                'mapping' => 'full_name',
                'formatting' => json_encode(['trim', 'uppercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source4Id,
                'model' => 'App\Models\TestNisit',
                'field' => 'email',
                'mapping' => 'email_address',
                'formatting' => json_encode(['trim', 'lowercase']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source4Id,
                'model' => 'App\Models\TestNisit',
                'field' => 'password',
                'mapping' => 'password',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source5Id,
                'model' => 'App\Models\TestNisit',
                'field' => 'student_id',
                'mapping' => 'nisit_id',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source5Id,
                'model' => 'App\Models\TestNisit',
                'field' => 'phone_number',
                'mapping' => 'telephone',
                'formatting' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source5Id,
                'model' => 'App\Models\TestNisit',
                'field' => 'bio',
                'mapping' => 'about_me',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'data_source_id' => $source5Id,
                'model' => 'App\Models\TestNisit',
                'field' => 'avatar',
                'mapping' => 'profile_picture',
                'formatting' => json_encode(['trim']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
