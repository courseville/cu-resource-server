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
        Schema::create('data_conflicts', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('model_class');
            $blueprint->string('model_pk_value');
            $blueprint->foreignId('data_source_id')->constrained('data_sources')->cascadeOnDelete();
            $blueprint->json('incoming_data');
            $blueprint->json('current_data');
            $blueprint->string('status')->default('pending'); // pending, resolved_incoming, resolved_current
            $blueprint->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();
            $blueprint->timestamp('resolved_at')->nullable();
            $blueprint->timestamps();

            $blueprint->index(['model_class', 'model_pk_value']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_conflicts');
    }
};
