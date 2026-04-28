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
        Schema::table('students', function (Blueprint $table) {
            $table->string('faccode')->nullable()->after('student_id');
            $table->string('depcode')->nullable()->after('faccode');
        });

        Schema::table('personnels', function (Blueprint $table) {
            $table->string('faccode')->nullable()->after('personnel_id');
            $table->string('depcode')->nullable()->after('faccode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['faccode', 'depcode']);
        });

        Schema::table('personnels', function (Blueprint $table) {
            $table->dropColumn(['faccode', 'depcode']);
        });
    }
};
