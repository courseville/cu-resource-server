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
        Schema::create('academic_programs', function (Blueprint $table) {
            $table->id();
            $table->string('oaa_program_id')->index();
            $table->string('ops_no')->nullable();
            $table->string('program_name_th')->nullable();
            $table->string('program_name_en')->nullable();
            $table->string('title_degree_th')->nullable();
            $table->string('title_degree_en')->nullable();
            $table->string('degree_name_th')->nullable();
            $table->string('degree_name_en')->nullable();
            $table->string('level_code')->nullable();

            // Domain fields
            $table->string('faculty_code')->nullable()->index();

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
        Schema::dropIfExists('academic_programs');
    }
};
