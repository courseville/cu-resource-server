<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DgReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Register Data Sources
        $facSourceId = DB::table('data_sources')->insertGetId([
            'name' => 'DG Faculty',
            'type' => 'file',
            'url' => 'storage:local:dg/faccode.csv',
            'is_active' => true,
            'order' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $majorSourceId = DB::table('data_sources')->insertGetId([
            'name' => 'DG Major',
            'type' => 'file',
            'url' => 'storage:local:dg/majorcode.csv',
            'is_active' => true,
            'order' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $depSourceId = DB::table('data_sources')->insertGetId([
            'name' => 'DG Department',
            'type' => 'file',
            'url' => 'storage:local:dg/depcode.csv',
            'is_active' => true,
            'order' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 2. Register Primary Keys
        DB::table('pk_model_fields')->insert([
            ['model' => 'App\Models\Resources\Faculty', 'primary_key' => 'faccode', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['model' => 'App\Models\Resources\Major', 'primary_key' => 'majorcode', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['model' => 'App\Models\Resources\Department', 'primary_key' => 'depcode', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // 3. Register Transformer Mappings
        DB::table('transformer_mappings')->insert([
            // Faculty
            ['data_source_id' => $facSourceId, 'model' => 'App\Models\Resources\Faculty', 'field' => 'faccode', 'mapping' => 'faccode', 'formatting' => '[]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['data_source_id' => $facSourceId, 'model' => 'App\Models\Resources\Faculty', 'field' => 'name_th', 'mapping' => 'name_th', 'formatting' => '["trim"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['data_source_id' => $facSourceId, 'model' => 'App\Models\Resources\Faculty', 'field' => 'name_en', 'mapping' => 'name_en', 'formatting' => '["trim"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            
            // Major
            ['data_source_id' => $majorSourceId, 'model' => 'App\Models\Resources\Major', 'field' => 'majorcode', 'mapping' => 'majorcode', 'formatting' => '[]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['data_source_id' => $majorSourceId, 'model' => 'App\Models\Resources\Major', 'field' => 'name_th', 'mapping' => 'name_th', 'formatting' => '["trim"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['data_source_id' => $majorSourceId, 'model' => 'App\Models\Resources\Major', 'field' => 'name_en', 'mapping' => 'name_en', 'formatting' => '["trim"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Department
            ['data_source_id' => $depSourceId, 'model' => 'App\Models\Resources\Department', 'field' => 'depcode', 'mapping' => 'depcode', 'formatting' => '[]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['data_source_id' => $depSourceId, 'model' => 'App\Models\Resources\Department', 'field' => 'name_th', 'mapping' => 'name_th', 'formatting' => '["trim"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['data_source_id' => $depSourceId, 'model' => 'App\Models\Resources\Department', 'field' => 'name_en', 'mapping' => 'name_en', 'formatting' => '["trim"]', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
