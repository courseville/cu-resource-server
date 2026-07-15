<?php

namespace Database\Seeders;

use App\Models\TestNisit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrimaryModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pk_model_fields')->insert([
            ['model' => TestNisit::class, 'primary_key' => 'student_id'],
        ]);
    }
}
