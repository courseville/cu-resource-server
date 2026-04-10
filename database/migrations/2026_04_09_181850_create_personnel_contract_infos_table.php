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
        Schema::create('personnel_contract_infos', function (Blueprint $table) {
            $table->id();
            $table->string('personnel_id')->nullable();
            $table->string('begin_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('status_id')->nullable();
            $table->string('title_th')->nullable();
            $table->string('name_th')->nullable();
            $table->string('surname_th')->nullable();
            $table->string('title_en')->nullable();
            $table->string('name_en')->nullable();
            $table->string('surname_en')->nullable();
            $table->string('email')->nullable();
            $table->string('nation')->nullable();
            $table->string('citizen_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('staff_group')->nullable();
            $table->string('personnel_grp_id')->nullable();
            $table->string('personnel_grp_name')->nullable();
            $table->string('position_name')->nullable();
            $table->string('position_number')->nullable();
            $table->string('contract_type_id')->nullable();
            $table->string('contract_type_name')->nullable();
            $table->string('contract_end_date')->nullable();
            $table->string('btrtl')->nullable();
            $table->string('btrtl_text')->nullable();
            $table->string('stell')->nullable();
            $table->string('stell_text')->nullable();
            $table->string('organization_id')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('structure_level1_name')->nullable();
            $table->string('structure_level2_name')->nullable();
            $table->string('structure_level3_name')->nullable();
            $table->string('structure_level4_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_contract_infos');
    }
};
