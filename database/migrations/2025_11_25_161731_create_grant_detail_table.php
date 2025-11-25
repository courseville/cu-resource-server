<?php

use App\Models\Resources\Student;
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
        Schema::create('grant_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('type')->nullable();
            $table->decimal('travel_cost', 10, 2)->nullable();
            $table->decimal('accommodation_cost', 10, 2)->nullable();
            $table->boolean('lump_sum_allowance')->nullable();
            $table->string('first_student_id')->nullable();
            $table->string('second_student_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grant_detail');
    }
};
