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
        Schema::create('departments', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('depcode')->unique();
            $blueprint->string('name_th')->nullable();
            $blueprint->string('name_en')->nullable();
            $blueprint->json('sync_meta')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
