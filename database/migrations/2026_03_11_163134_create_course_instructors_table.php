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
        Schema::create('course_instructors', function (Blueprint $table) {
            $table->id();
            $table->string('acad_year')->nullable();
            $table->string('semester')->nullable();
            $table->string('course_code')->index();
            $table->string('row_seq')->nullable();
            $table->string('section')->nullable();
            $table->string('instructor_no')->index();
            $table->string('prename_code')->nullable();
            $table->string('prename_describe')->nullable();
            $table->string('title_code')->nullable();
            $table->string('title_describe')->nullable();
            $table->string('position')->nullable();
            $table->string('name_thai')->nullable();
            $table->string('surname_thai')->nullable();
            $table->string('name_english')->nullable();
            $table->string('surname_english')->nullable();
            $table->string('name_abbr')->nullable();
            $table->string('sex')->nullable();

            // Domain fields
            $table->string('faccode')->nullable()->index();
            $table->string('depcode')->nullable()->index();

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
        Schema::dropIfExists('course_instructors');
    }
};
