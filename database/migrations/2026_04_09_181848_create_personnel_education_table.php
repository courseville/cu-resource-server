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
        Schema::create('personnel_education', function (Blueprint $table) {
            $table->id();
            $table->string('personnel_id')->nullable();
            $table->string('begin_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('education_level_id')->nullable();
            $table->string('education_level_name')->nullable();
            $table->string('institution_id')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('major_id')->nullable();
            $table->string('major_name')->nullable();
            $table->string('degree_id')->nullable();
            $table->string('degree_name')->nullable();
            $table->string('nation_id')->nullable();
            $table->string('nation_name_th')->nullable();
            $table->string('distinction_id')->nullable();
            $table->string('distinction_name')->nullable();
            $table->string('highest_education')->nullable();
            $table->string('highest_education_th')->nullable();
            $table->string('employ_education_id')->nullable();
            $table->string('employ_education_name')->nullable();
            $table->string('graduate_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_education');
    }
};
