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
        Schema::create('personnel_positions', function (Blueprint $table) {
            $table->id();
            $table->string('personnel_id')->nullable();
            $table->string('begin_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('positiontype_id')->nullable();
            $table->string('positiontype_name')->nullable();
            $table->string('positiontype_text')->nullable();
            $table->string('fieldstudy')->nullable();
            $table->string('subdiscipline_1')->nullable();
            $table->string('subdiscipline_2')->nullable();
            $table->string('subdiscipline_3')->nullable();
            $table->string('subdiscipline_4')->nullable();
            $table->string('subdiscipline_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_positions');
    }
};
