<?php

use App\Models\Resources\Interviewer;
use App\Models\Resources\StudentApplication;
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
        Schema::create('interview_quota', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StudentApplication::class, 'application_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Interviewer::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_quota');
    }
};
