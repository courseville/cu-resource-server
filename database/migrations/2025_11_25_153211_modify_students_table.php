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
        Schema::table('students', function (Blueprint $table) {
            $table->string('national_id')->nullable();
            $table->dateTime('birth')->nullable();
            $table->text('image')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('current_address')->nullable();
            $table->string('current_district')->nullable();
            $table->string('current_province')->nullable();
            $table->string('current_zip_code')->nullable();
            $table->decimal('current_latitude', 11, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->text('hometown_address')->nullable();
            $table->string('hometown_district')->nullable();
            $table->string('hometown_province')->nullable();
            $table->string('hometown_zip_code')->nullable();
            $table->decimal('hometown_latitude', 11, 8)->nullable();
            $table->decimal('hometown_longitude', 11, 8)->nullable();
            $table->string('father_first_name')->nullable();
            $table->string('father_last_name')->nullable();
            $table->integer('father_birth_year')->nullable();
            $table->string('father_status')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_last_name')->nullable();
            $table->integer('mother_birth_year')->nullable();
            $table->string('mother_status')->nullable();
            $table->string('parent_relationship')->nullable();
            $table->string('parent_phone')->nullable();
            $table->integer('sibling_total')->nullable();
            $table->integer('sibling_order')->nullable();
            $table->text('parent_address')->nullable();
            $table->string('parent_district')->nullable();
            $table->string('parent_province')->nullable();
            $table->string('parent_zip_code')->nullable();
            $table->decimal('parent_latitude', 11, 8)->nullable();
            $table->decimal('parent_longitude', 11, 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
