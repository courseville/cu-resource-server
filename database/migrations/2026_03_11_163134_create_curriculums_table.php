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
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('course_code_no')->index();
            $table->string('major_code')->index();
            $table->string('degree')->nullable();
            $table->string('major')->nullable();
            $table->integer('no_year_study')->nullable();
            $table->string('plan1')->nullable();
            $table->string('language1')->nullable();
            $table->string('program_system')->nullable();
            $table->string('calendar')->nullable();
            $table->string('begin_year')->nullable();
            $table->string('begin_semester')->nullable();

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
        Schema::dropIfExists('curriculums');
    }
};
