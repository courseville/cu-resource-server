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
        Schema::create('personnel_contract_details', function (Blueprint $table) {
            $table->id();
            $table->string('personnel_id')->nullable();
            $table->string('begin_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('contract_type_id')->nullable();
            $table->string('contract_type_name')->nullable();
            $table->string('probation')->nullable();
            $table->string('probation_unit')->nullable();
            $table->string('contract_end_date')->nullable();
            $table->string('disemploy_employer')->nullable();
            $table->string('disemploy_employee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_contract_details');
    }
};
