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
        Schema::create('personnel_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('personnel_id')->nullable();
            $table->string('begin_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('title_id')->nullable();
            $table->string('title_th')->nullable();
            $table->string('name_th')->nullable();
            $table->string('surname_th')->nullable();
            $table->string('gender')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('rank_title')->nullable();
            $table->string('doctoral_title')->nullable();
            $table->string('acad_title_1')->nullable();
            $table->string('acad_title_2')->nullable();
            $table->string('title_by_the_king')->nullable();
            $table->string('nation')->nullable();
            $table->string('marrital_status')->nullable();
            $table->string('email')->nullable();
            $table->string('title_en')->nullable();
            $table->string('name_en')->nullable();
            $table->string('surname_en')->nullable();
            $table->string('citizen_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('office_phonenumber')->nullable();
            $table->string('full_title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_profiles');
    }
};
