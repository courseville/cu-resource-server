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
        Schema::create('student_status_histories', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->index();
            $table->string('name_thai')->nullable();
            $table->string('name_english')->nullable();
            $table->string('status')->nullable();
            $table->string('effect_date')->nullable();
            $table->string('from_acad_year')->nullable();
            $table->string('from_semester')->nullable();
            $table->string('to_acad_year')->nullable();
            $table->string('to_semester')->nullable();
            $table->string('instruction_no')->nullable();
            $table->string('announcement')->nullable();

            // Domain fields
            $table->string('faccode')->nullable()->index();
            $table->string('depcode')->nullable()->index();
            $table->string('majorcode')->nullable()->index();

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
        Schema::dropIfExists('student_status_histories');
    }
};
