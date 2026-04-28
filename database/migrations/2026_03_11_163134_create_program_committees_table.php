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
        Schema::create('program_committees', function (Blueprint $table) {
            $table->id();
            $table->string('program_no')->index();
            $table->string('active_year')->nullable();
            $table->string('committee_tag')->nullable();
            $table->string('effective_date')->nullable();
            $table->string('personal_id')->index();

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
        Schema::dropIfExists('program_committees');
    }
};
