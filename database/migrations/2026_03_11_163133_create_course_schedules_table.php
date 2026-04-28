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
        Schema::create('course_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('semester')->nullable();
            $table->string('course_code')->index();
            $table->string('course_name')->nullable();
            $table->string('section')->nullable();
            $table->string('row_seq')->nullable();
            $table->string('teach_type')->nullable();
            $table->string('day1')->nullable();
            $table->string('day2')->nullable();
            $table->string('day3')->nullable();
            $table->string('day4')->nullable();
            $table->string('day5')->nullable();
            $table->string('day6')->nullable();
            $table->string('day7')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('building')->nullable();
            $table->string('room')->nullable();
            $table->string('study_program_system')->nullable();
            $table->string('gen_ed_status')->nullable();
            $table->string('general_subject')->nullable();
            $table->decimal('lecture_credit', 8, 3)->nullable();
            $table->decimal('non_lecture_credit', 8, 3)->nullable();
            $table->decimal('total_credit', 8, 3)->nullable();
            $table->integer('real_reg')->nullable();
            $table->integer('total_reg')->nullable();
            $table->text('remark1')->nullable();
            $table->text('remark2')->nullable();
            $table->text('remark3')->nullable();

            // Domain fields
            $table->string('faccode')->nullable()->index();

            // Ingestion fields
            $table->foreignId('data_source_id')->nullable()->constrained('data_sources')->onDelete('cascade');
            $table->string('data_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_schedules');
    }
};
