<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('personnels', function (Blueprint $table) {
            $table->string('rank_title')->nullable();
            $table->string('doctoral_title')->nullable();
            $table->string('acad_title_1')->nullable();
            $table->string('acad_title_2')->nullable();
            $table->string('title_by_the_king')->nullable();
            $table->string('full_title')->nullable();

            $table->string('citizen_id')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('marital_status')->nullable();

            $table->string('department')->nullable();
            $table->string('personnel_type')->nullable();
            $table->string('personnel_status')->nullable();
            $table->date('status_change_date')->nullable();
            $table->string('personnel_group')->nullable();
            $table->string('personnel_subgroup')->nullable();
            $table->string('position_name')->nullable();
            $table->string('position_number')->nullable();
            $table->date('position_appointment_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('transformation_date')->nullable();

            $table->string('structure_level1_name')->nullable();
            $table->string('structure_level2_name')->nullable();
            $table->string('structure_level3_name')->nullable();
            $table->string('structure_level4_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personnels', function (Blueprint $table) {
            $table->dropColumn([
                'rank_title',
                'doctoral_title',
                'acad_title_1',
                'acad_title_2',
                'title_by_the_king',
                'full_title',
                'citizen_id',
                'birth_date',
                'marital_status',
                'department',
                'personnel_type',
                'personnel_status',
                'status_change_date',
                'personnel_group',
                'personnel_subgroup',
                'position_name',
                'position_number',
                'position_appointment_date',
                'start_date',
                'transformation_date',
                'structure_level1_name',
                'structure_level2_name',
                'structure_level3_name',
                'structure_level4_name',
            ]);
        });
    }
};
