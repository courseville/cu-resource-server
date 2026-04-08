<?php

namespace Tests\Feature;

use App\Models\DataSource;
use App\Models\PkModel;
use App\Models\Resources\Student;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SyncDataMysqlTest extends TestCase
{
    use RefreshDatabase;

    public function test_mysql_data_sync()
    {
        // 0. Setup User (required for Import model user_id foreign key)
        \App\Models\User::factory()->create(['id' => 1]);

        // 1. Setup DataSource connection
        // We use a file-based SQLite database to ensure the connection is shared
        // between the test and the Artisan command.
        $tempDb = tempnam(sys_get_temp_dir(), 'sync_test_');
        config(['database.connections.sync_test' => [
            'driver' => 'sqlite',
            'database' => $tempDb,
            'prefix' => '',
        ]]);

        // 2. Prepare "remote" table in the sync_test connection
        Schema::connection('sync_test')->create('remote_students', function (Blueprint $table) {
            $table->id();
            $table->string('sid');
            $table->string('name_th');
            $table->string('name_en');
        });

        DB::connection('sync_test')->table('remote_students')->insert([
            ['id' => 1, 'sid' => '60300001', 'name_th' => 'สมชาย', 'name_en' => 'Somchai'],
            ['id' => 2, 'sid' => '60300002', 'name_th' => 'สมศรี', 'name_en' => 'Somsri'],
        ]);

        $source = DataSource::create([
            'name' => 'MySQL Source',
            'type' => 'mysql',
            'url' => 'sync_test:remote_students',
            'is_active' => true,
        ]);

        // 3. Setup Mappings (direct DB insert to bypass potential model issues if TransformerMapping is not fully defined)
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
    }
}
