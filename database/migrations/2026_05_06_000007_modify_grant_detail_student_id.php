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
        Schema::table('grant_detail', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->string('student_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grant_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->change();
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
        });
    }
};
