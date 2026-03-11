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
        Schema::create('student_graduations', function (Blueprint $table) {
            $table->id();
            $table->string('acad_year')->nullable();
            $table->string('semester')->nullable();
            $table->string('student_code')->index();
            $table->string('name_thai')->nullable();
            $table->string('name_english')->nullable();
            $table->string('major_thai')->nullable();
            $table->string('major_english')->nullable();
            $table->string('degree_thai')->nullable();
            $table->string('degree_english')->nullable();
            $table->string('graduate_date')->nullable();
            $table->string('concil_date')->nullable();
            $table->string('distinction')->nullable();

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
        Schema::dropIfExists('student_graduations');
    }
};
