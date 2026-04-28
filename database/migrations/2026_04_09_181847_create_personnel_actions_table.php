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
        Schema::create('personnel_actions', function (Blueprint $table) {
            $table->id();
            $table->string('personnel_id')->nullable();
            $table->string('begin_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('status_id')->nullable();
            $table->string('status_name')->nullable();
            $table->string('action_id')->nullable();
            $table->string('action_name')->nullable();
            $table->string('reason_id')->nullable();
            $table->string('reason_name')->nullable();
            $table->string('modify_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_actions');
    }
};
