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
        Schema::create('personnel_images', function (Blueprint $table) {
            $table->id();
            $table->string('personnel_id')->nullable();
            $table->string('citizen_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('image_name')->nullable();
            $table->string('begin_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_images');
    }
};
