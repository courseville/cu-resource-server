<?php

namespace Tests\Feature;

use App\Models\DataSource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DataSyncAuditTest extends TestCase
{
    use RefreshDatabase;

    public function test_sync_data_logs_to_data_imports()
    {
        User::factory()->create(['id' => 1]);
        Storage::fake('local');
        Storage::disk('local')->put('test.csv', "student_id,name_thai\nS1,Student One");

        // Add a mock data source
        $source = DataSource::create([
            'name' => 'Test Source',
            'url' => 'storage:local:test.csv',
        ]);

        // Assuming the command runs:
        Artisan::call('app:sync-data');

        // Verify auditing record exists
        $this->assertDatabaseHas('imports', [
            'file_name' => 'storage:local:test.csv',
        ]);
    }
}
