<?php

namespace Tests\Feature;

use App\Models\DataConflict;
use App\Models\DataSource;
use App\Models\Import;
use App\Models\PkModel;
use App\Models\Resources\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class SyncConflictTest extends TestCase
{
    use RefreshDatabase;

    public function test_sync_detects_conflicts_and_logs_them()
    {
        // 1. Setup existing data
        $student = Student::create([
            'student_id' => 'S001',
            'first_name_th' => 'Old Name',
            'last_name_th' => 'Old Surname',
            'faccode' => '21',
        ]);

        // 2. Setup PK mapping
        PkModel::create([
            'model' => Student::class,
            'primary_key' => 'student_id',
        ]);

        // 3. Setup data source and import
        $source = DataSource::create([
            'name' => 'Test Source',
            'type' => 'file',
            'url' => 'test.csv',
        ]);

        $user = \App\Models\User::factory()->create();

        $import = Import::create([
            'data_source_id' => $source->id,
            'file_name' => 'test.csv',
            'file_path' => 'test.csv',
            'importer' => 'Test',
            'total_rows' => 1,
            'user_id' => $user->id,
        ]);

        // 4. Manually trigger sync logic
        $command = new \App\Console\Commands\SyncData();
        
        $transformedItem = [
            'student_id' => 'S001',
            'first_name_th' => 'New Name',
            'last_name_th' => 'Old Surname',
            'faccode' => '21',
        ];

        // Access protected method for testing
        $reflection = new \ReflectionClass($command);
        $method = $reflection->getMethod('syncModelItem');
        $method->setAccessible(true);

        $result = $method->invoke($command, Student::class, $transformedItem, [], $import);

        $this->assertTrue($result);

        // 5. Verify conflict was created
        $this->assertDatabaseHas('data_conflicts', [
            'model_class' => Student::class,
            'model_pk_value' => 'S001',
            'status' => 'pending',
        ]);

        $conflict = DataConflict::first();
        $this->assertEquals('New Name', $conflict->incoming_data['first_name_th']);
        $this->assertEquals('Old Name', $conflict->current_data['first_name_th']);

        // 6. Verify original record was NOT updated
        $student->refresh();
        $this->assertEquals('Old Name', $student->first_name_th);
    }
}
