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
        Schema::create('internship_student', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->nullable()->constrained()->cascadeOnDelete();
            $table->integer('process_step')->nullable();
            $table->string('status')->nullable();
            $table->boolean('grant')->nullable();
            $table->text('file')->nullable();
            $table->text('address_pic')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('location_address')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_name')->nullable();
            $table->text('job_description')->nullable();
            $table->string('sup_name')->nullable();
            $table->string('sup_position')->nullable();
            $table->string('sup_phone')->nullable();
            $table->string('company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_student');
    }
};
