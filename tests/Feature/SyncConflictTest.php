<?php

namespace Tests\Feature;

use App\Models\DataConflict;
use App\Models\DataSource;
use App\Models\Import;
use App\Models\PkModel;
use App\Models\Resources\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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

        // Setup transformer mappings for the mapped fields
        DB::table('transformer_mappings')->insert([
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'student_id',
                'mapping' => 'student_id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'first_name_th',
                'mapping' => 'first_name_th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'last_name_th',
                'mapping' => 'last_name_th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'faccode',
                'mapping' => 'faccode',
                'created_at' => now(),
                'updated_at' => now(),
            ],
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

    public function test_sync_ignores_conflict_if_only_unmapped_field_differs()
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

        // Setup transformer mappings - ONLY mapping student_id, first_name_th, last_name_th. NOT faccode!
        DB::table('transformer_mappings')->insert([
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'student_id',
                'mapping' => 'student_id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'first_name_th',
                'mapping' => 'first_name_th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'last_name_th',
                'mapping' => 'last_name_th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
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
        
        // faccode is different ('99' vs '21'), but since it is NOT in the mappings,
        // it shouldn't trigger a conflict.
        $transformedItem = [
            'student_id' => 'S001',
            'first_name_th' => 'Old Name',
            'last_name_th' => 'Old Surname',
            'faccode' => '99',
        ];

        // Access protected method for testing
        $reflection = new \ReflectionClass($command);
        $method = $reflection->getMethod('syncModelItem');
        $method->setAccessible(true);

        $result = $method->invoke($command, Student::class, $transformedItem, [], $import);

        $this->assertTrue($result);

        // 5. Verify no conflict was created
        $this->assertDatabaseMissing('data_conflicts', [
            'model_class' => Student::class,
            'model_pk_value' => 'S001',
        ]);

        // 6. Verify original record WAS updated/written
        $student->refresh();
        $this->assertEquals('99', $student->faccode);
    }

    public function test_sync_detects_conflict_on_null_fill_if_field_is_present()
    {
        // 1. Setup existing data with NULL name
        $student = Student::create([
            'student_id' => 'S001',
            'first_name_th' => null,
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

        // Setup transformer mappings
        DB::table('transformer_mappings')->insert([
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'student_id',
                'mapping' => 'student_id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'first_name_th',
                'mapping' => 'first_name_th_source',
                'created_at' => now(),
                'updated_at' => now(),
            ],
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

        $command = new \App\Console\Commands\SyncData();
        
        $transformedItem = [
            'student_id' => 'S001',
            'first_name_th' => 'New Name',
        ];

        // Pass first_name_th_source in originalItem to simulate field presence in CSV
        $originalItem = [
            'student_id' => 'S001',
            'first_name_th_source' => 'New Name',
        ];

        $reflection = new \ReflectionClass($command);
        $method = $reflection->getMethod('syncModelItem');
        $method->setAccessible(true);

        $result = $method->invoke($command, Student::class, $transformedItem, $originalItem, $import);

        $this->assertTrue($result);

        // Verify conflict was created since the field is present and values differ (null vs 'New Name')
        $this->assertDatabaseHas('data_conflicts', [
            'model_class' => Student::class,
            'model_pk_value' => 'S001',
            'status' => 'pending',
        ]);
    }

    public function test_sync_ignores_conflict_if_mapped_field_is_missing_from_incoming_raw_data()
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

        // Setup transformer mappings
        DB::table('transformer_mappings')->insert([
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'student_id',
                'mapping' => 'student_id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_source_id' => $source->id,
                'model' => Student::class,
                'field' => 'first_name_th',
                'mapping' => 'first_name_th_source',
                'created_at' => now(),
                'updated_at' => now(),
            ],
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

        $command = new \App\Console\Commands\SyncData();
        
        // first_name_th is transformed to null because it's missing in raw incoming row
        $transformedItem = [
            'student_id' => 'S001',
            'first_name_th' => null,
        ];

        // Simulate CSV row missing 'first_name_th_source' column
        $originalItem = [
            'student_id' => 'S001',
        ];

        $reflection = new \ReflectionClass($command);
        $method = $reflection->getMethod('syncModelItem');
        $method->setAccessible(true);

        $result = $method->invoke($command, Student::class, $transformedItem, $originalItem, $import);

        $this->assertTrue($result);

        // Verify NO conflict was created
        $this->assertDatabaseMissing('data_conflicts', [
            'model_class' => Student::class,
            'model_pk_value' => 'S001',
        ]);

        // Verify database value remained unchanged
        $student->refresh();
        $this->assertEquals('Old Name', $student->first_name_th);
    }
}

