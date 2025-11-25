<?php

use App\Models\Resources\Personnel;
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
        Schema::create('retired_personnel', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Personnel::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('retired_id')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('type')->nullable();
            $table->string('citizen_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retired_personnel');
    }
};
