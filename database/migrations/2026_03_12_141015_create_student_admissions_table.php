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
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->nullable()->index();
            $table->string('name_thai')->nullable();
            $table->string('name_english')->nullable();
            $table->string('faccode')->nullable()->index();
            $table->string('depcode')->nullable()->index();
            $table->string('majorcode')->nullable()->index();
            $table->string('admission_type')->nullable()->index();
            $table->string('apply_year')->nullable();
            $table->string('apply_semester')->nullable();
            $table->date('apply_date')->nullable();
            $table->string('apply_status')->nullable();

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
        Schema::dropIfExists('student_admissions');
    }
};
