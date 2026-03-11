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
        Schema::create('student_curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('semester')->nullable();
            $table->string('student_code')->nullable();
            $table->string('name_thai')->nullable();
            $table->string('name_english')->nullable();
            $table->string('course_code')->nullable();
            $table->string('course_name')->nullable();
            $table->string('section')->nullable();
            $table->string('grade')->nullable();
            $table->decimal('credit_tot', 8, 3)->nullable();
            $table->string('faccode')->nullable();
            $table->string('depcode')->nullable();
            $table->string('majorcode')->nullable();

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
        Schema::dropIfExists('student_curriculums');
    }
};
