<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transformer_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_source_id')
                ->constrained('data_sources')
                ->onDelete('cascade')
                ->after('id');
            $table->string('model');
            $table->string('field');
            $table->string('mapping');
            $table->text('formatting')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transformer_mappings');
    }
};
