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
        Schema::table('student_internships', function (Blueprint $blueprint) {
            $blueprint->foreignId('company_id')->nullable()->after('student_id')->constrained('companies')->nullOnDelete();
            
            // Note: We are keeping the original columns for now to allow for data migration.
            // They will be dropped in a separate migration or after Task 2.1 validation.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_internships', function (Blueprint $blueprint) {
            $blueprint->dropForeign(['company_id']);
            $blueprint->dropColumn('company_id');
        });
    }
};
