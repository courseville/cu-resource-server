<?php

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
        Schema::create('admission_application', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StudentApplication::class, 'application_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('school')->nullable();
            $table->decimal('score', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_application');
    }
};
