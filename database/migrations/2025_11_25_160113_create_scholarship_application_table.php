<?php

use App\Models\Resources\Scholarship;
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
        Schema::create('scholarship_application', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Scholarship::class)->nullable()->constrained()->cascadeOnDelete();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->decimal('gpax', 3, 2)->nullable();
            $table->string('phone_brand_model')->nullable();
            $table->decimal('phone_monthly_cost', 8, 2)->nullable();
            $table->text('reason_for_scholarship')->nullable();
            $table->text('financial_self_support_plan')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->text('account_book_pdf')->nullable(); // Store file path
            $table->text('application_document_pdf')->nullable(); // Store file path
            $table->decimal('total_family_debt', 10, 2)->nullable();
            $table->text('debt_details')->nullable();
            $table->text('house_description')->nullable();
            $table->text('house_and_surroundings_image')->nullable(); // Store file path
            $table->text('house_interior_image')->nullable(); // Store file path
            $table->integer('number_of_cars')->nullable();
            $table->text('car_description')->nullable();
            $table->integer('sibling_order')->nullable();
            $table->integer('family_member_count')->nullable();
            $table->integer('number_of_employed_siblings')->nullable();
            $table->integer('guardian_dependent_count')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->decimal('mother_monthly_income', 10, 2)->nullable();
            $table->string('father_occupation')->nullable();
            $table->decimal('father_monthly_income', 10, 2)->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->decimal('guardian_monthly_income', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_application');
    }
};
