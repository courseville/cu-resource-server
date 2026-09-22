<?php

namespace Tests\Feature;

use App\Models\DataSource;
use App\Models\PkModel;
use App\Models\Resources\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ApiSourceHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_json_data_sync()
    {
        // 0. Setup User
        \App\Models\User::factory()->create(['id' => 1]);

        // 1. Setup DataSource
        config(['apisource.testapi' => [
            'base_url' => 'https://api.testapi.local',
            'auth_type' => 'none',
            'data_path' => 'data',
        ]]);

        // 2. Fake the remote HTTP response
        Http::fake([
            'https://api.testapi.local/students*' => Http::response([
                'data' => [
                    ['sid' => '60300001', 'name_th' => 'สมชาย', 'name_en' => 'Somchai'],
                    ['sid' => '60300002', 'name_th' => 'สมศรี', 'name_en' => 'Somsri'],
                ],
            ], 200),
        ]);

        $source = DataSource::create([
            'name' => 'Generic API Source',
            'type' => 'api',
            'url' => 'testapi:students',
            'is_active' => true,
        ]);

        // 3. Setup Mappings
        DB::table('transformer_mappings')->insert([
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'student_id',
                'mapping' => 'sid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'full_name_th',
                'mapping' => 'name_th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 4. Setup PkModel
        PkModel::create([
            'model' => Student::class,
            'primary_key' => 'student_id',
        ]);

        // 5. Run Sync
        $this->artisan('app:sync-data')
            ->assertExitCode(0);

        // 6. Verify data
        $this->assertDatabaseHas('students', [
            'student_id' => '60300001',
            'full_name_th' => 'สมชาย',
        ]);
        $this->assertDatabaseHas('students', [
            'student_id' => '60300002',
            'full_name_th' => 'สมศรี',
        ]);

        // 7. Verify audit
        $this->assertDatabaseHas('imports', [
            'data_source_id' => $source->id,
            'successful_rows' => 2,
        ]);

        // 8. Verify last_synced_at was advanced
        $this->assertNotNull($source->fresh()->last_synced_at);
    }

    public function test_api_paginated_data_sync_with_firstclass_provider()
    {
        // 0. Setup User
        \App\Models\User::factory()->create(['id' => 1]);

        // 1. Setup DataSource
        config(['apisource.firstclass' => [
            'base_url' => 'https://api.firstclass.local',
            'auth_type' => 'bearer',
            'api_key' => 'fake-token',
            'data_path' => 'data',
        ]]);

        // 2.Two pages of the "checkins" endpoint
        Http::fake([
            'https://api.firstclass.local/checkins*' => Http::sequence()
                ->push([
                    'data' => [
                        ['sid' => '60300001', 'name_th' => 'สมชาย'],
                    ],
                    'meta' => ['total_pages' => 2],
                ], 200)
                ->push([
                    'data' => [
                        ['sid' => '60300002', 'name_th' => 'สมศรี'],
                    ],
                    'meta' => ['total_pages' => 2],
                ], 200),
        ]);

        $source = DataSource::create([
            'name' => 'FirstClass Checkins',
            'type' => 'api',
            'url' => 'firstclass:checkins',
            'is_active' => true,
        ]);

        // 3. Setup Mappings
        DB::table('transformer_mappings')->insert([
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'student_id',
                'mapping' => 'sid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'full_name_th',
                'mapping' => 'name_th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 4. Setup PkModel
        PkModel::create([
            'model' => Student::class,
            'primary_key' => 'student_id',
        ]);

        // 5. Run Sync
        $this->artisan('app:sync-data')
            ->assertExitCode(0);

        // 6. Verify data from both pages was synced
        $this->assertDatabaseHas('students', [
            'student_id' => '60300001',
            'full_name_th' => 'สมชาย',
        ]);
        $this->assertDatabaseHas('students', [
            'student_id' => '60300002',
            'full_name_th' => 'สมศรี',
        ]);

        // 7. Verify audit reflects both rows across both pages
        $this->assertDatabaseHas('imports', [
            'data_source_id' => $source->id,
            'successful_rows' => 2,
        ]);

        // 8. Verify both HTTP calls were made (page 1 and page 2)
        Http::assertSentInOrder([
            fn ($request) => $request->url() === 'https://api.firstclass.local/checkins?page=1&per_page=500',
            fn ($request) => $request->url() === 'https://api.firstclass.local/checkins?page=2&per_page=500',
        ]);
    }

    public function test_api_source_with_invalid_url_format_is_skipped()
    {
        // missing the ':endpoint' part
        $source = DataSource::create([
            'name' => 'Broken API Source',
            'type' => 'api',
            'url' => 'testapi',
            'is_active' => true,
        ]);

        $this->artisan('app:sync-data')
            ->assertExitCode(0);

        $this->assertDatabaseMissing('imports', [
            'data_source_id' => $source->id,
        ]);
    }
}
