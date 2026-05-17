<?php

namespace Tests\Feature;

use App\Models\DataSource;
use App\Models\Resources\Faculty;
use App\Models\Resources\Major;
use App\Models\Resources\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DgSyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_dg_reference_sync()
    {
        // 1. Mock storage
        Storage::fake('local');
        
        Storage::disk('local')->put('dg/faccode.csv', "faccode,name_th,name_en\n21,Faculty of Engineering,Faculty of Engineering\n");
        Storage::disk('local')->put('dg/majorcode.csv', "majorcode,name_th,name_en\n701,Computer Engineering,Computer Engineering\n");
        Storage::disk('local')->put('dg/depcode.csv', "depcode,name_th,name_en\n2110,Dept of Comp Eng,Dept of Comp Eng\n");

        // 2. Run seeder
        $this->seed(\Database\Seeders\DgReferenceSeeder::class);

        // 3. Run sync command
        Artisan::call('app:sync-data');

        // 4. Verify data in DB
        $this->assertDatabaseHas('faculties', ['faccode' => '21']);
        $this->assertDatabaseHas('majors', ['majorcode' => '701']);
        $this->assertDatabaseHas('departments', ['depcode' => '2110']);
    }
}
