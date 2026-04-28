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
        Schema::create('full_time_personnel', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Personnel::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('full_time_id')->nullable();
            $table->string('university')->nullable();
            $table->string('degree')->nullable();
            $table->string('education_level')->nullable();
            $table->dateTime('date_of_appointment')->nullable();
            $table->dateTime('asst_prof_date')->nullable();
            $table->dateTime('prof_date')->nullable();
            $table->dateTime('assoc_prof_date')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->integer('age')->nullable();
            $table->dateTime('personnel_status_changing_date')->nullable();
            $table->integer('salary_band')->nullable();
            $table->dateTime('teacher_date')->nullable();
            $table->string('job_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('full_time');
    }
};
