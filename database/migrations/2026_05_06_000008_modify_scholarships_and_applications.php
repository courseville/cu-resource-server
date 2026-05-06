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
        Schema::table('scholarships', function (Blueprint $table) {
            $table->integer('academic_year')->nullable()->change();
        });

        Schema::table('scholarship_application', function (Blueprint $table) {
            $table->decimal('mother_monthly_income', 15, 2)->nullable()->change();
            $table->decimal('father_monthly_income', 15, 2)->nullable()->change();
            $table->decimal('guardian_monthly_income', 15, 2)->nullable()->change();
            $table->decimal('total_family_debt', 15, 2)->nullable()->change();
            $table->decimal('money_a', 15, 2)->nullable()->change();
            $table->decimal('money_b', 15, 2)->nullable()->change();
            $table->decimal('money_c', 15, 2)->nullable()->change();
            $table->decimal('phone_monthly_cost', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->integer('academic_year')->nullable(false)->change();
        });

        Schema::table('scholarship_application', function (Blueprint $table) {
            $table->decimal('mother_monthly_income', 10, 2)->nullable()->change();
            $table->decimal('father_monthly_income', 10, 2)->nullable()->change();
            $table->decimal('guardian_monthly_income', 10, 2)->nullable()->change();
            $table->decimal('total_family_debt', 10, 2)->nullable()->change();
            $table->decimal('money_a', 10, 2)->nullable()->change();
            $table->decimal('money_b', 10, 2)->nullable()->change();
            $table->decimal('money_c', 10, 2)->nullable()->change();
            $table->decimal('phone_monthly_cost', 8, 2)->nullable()->change();
        });
    }
};
