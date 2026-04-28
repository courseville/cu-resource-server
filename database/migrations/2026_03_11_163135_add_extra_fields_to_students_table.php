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
        Schema::table('students', function (Blueprint $table) {
            $table->string('course_code_no')->nullable()->index();
            $table->string('faculty_group')->nullable();
            $table->string('major_code')->nullable()->index();
            $table->string('program_code')->nullable();
            $table->string('study_program_system')->nullable();
            $table->string('project_code')->nullable();
            $table->string('start_acad_year')->nullable();
            $table->string('start_semester')->nullable();
            $table->string('max_period')->nullable();
            $table->string('min_period')->nullable();
            $table->decimal('credit_tot', 8, 3)->nullable();
            $table->string('fac_name')->nullable();
            $table->string('dep_name')->nullable();
            $table->string('major_name')->nullable();
            $table->string('fac_name_eng')->nullable();
            $table->string('dep_name_eng')->nullable();
            $table->string('major_name_eng')->nullable();

            // Ingestion fields (if not already present)
            if (! Schema::hasColumn('students', 'data_source_id')) {
                $table->foreignId('data_source_id')->nullable()->constrained('data_sources')->onDelete('cascade');
            }
            if (! Schema::hasColumn('students', 'data_id')) {
                $table->string('data_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
