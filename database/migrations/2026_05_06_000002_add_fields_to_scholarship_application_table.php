<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scholarship_application', function (Blueprint $table) {
            $table->string('job_code')->nullable()->after('scholarship_id');
            $table->boolean('has_house')->nullable()->after('house_description');
            $table->boolean('confirm')->nullable()->after('bank_account_number');
            $table->string('status')->nullable()->default('pending')->after('confirm');
            $table->decimal('money_a', 10, 2)->nullable()->after('status');
            $table->decimal('money_b', 10, 2)->nullable()->after('money_a');
            $table->integer('money_b_m')->nullable()->after('money_b');
            $table->decimal('money_c', 10, 2)->nullable()->after('money_b_m');
            $table->timestamp('date_create')->nullable()->after('money_c');
            $table->timestamp('date_update')->nullable()->after('date_create');
        });
    }

    public function down(): void
    {
        Schema::table('scholarship_application', function (Blueprint $table) {
            $table->dropColumn([
                'job_code', 'has_house', 'confirm', 'status',
                'money_a', 'money_b', 'money_b_m', 'money_c',
                'date_create', 'date_update',
            ]);
        });
    }
};
