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
        Schema::create('structure_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_id')->constrained('personnels')->onDelete('cascade');
            $table->foreignId('structure_level1_id')->nullable()->constrained('structures')->onDelete('cascade');
            $table->foreignId('structure_level2_id')->nullable()->constrained('structures')->onDelete('cascade');
            $table->foreignId('structure_level3_id')->nullable()->constrained('structures')->onDelete('cascade');
            $table->foreignId('structure_level4_id')->nullable()->constrained('structures')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structure_profiles');
    }
};
