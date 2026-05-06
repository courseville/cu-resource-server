<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scholarship_application', function (Blueprint $table) {
            $table->dropForeign(['scholarship_id']);
            $table->dropColumn('scholarship_id');
            $table->dropForeign(['student_id']);
            $table->string('student_id')->change();
        });
    }

    public function down(): void
    {
        Schema::table('scholarship_application', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->change();
            $table->foreignId('scholarship_id')->nullable()->constrained('scholarships')->cascadeOnDelete();
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
        });
    }
};
