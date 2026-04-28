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
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->nullable();
            $table->string('year')->nullable();
            $table->string('semester')->nullable();
            $table->string('course_code')->nullable();
            $table->string('total_credit')->nullable();
            $table->string('grade')->nullable();
            $table->string('last_update')->nullable();
            $table->string('faccode')->nullable();
            $table->string('depcode')->nullable();
            $table->string('majorcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
