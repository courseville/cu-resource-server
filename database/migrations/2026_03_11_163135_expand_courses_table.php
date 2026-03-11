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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('course_id')->after('id')->nullable()->index();
            $table->string('program_id')->nullable();
            $table->string('type_code')->nullable();
            $table->string('program_group_id')->nullable();
            $table->string('course_no')->nullable()->index();
            $table->string('revision_year')->nullable();
            $table->string('name_th')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_abbr')->nullable();
            $table->decimal('l_credit', 8, 3)->nullable();
            $table->decimal('nl_credit', 8, 3)->nullable();
            $table->integer('l_hour')->nullable();
            $table->integer('nl_hour')->nullable();
            $table->integer('s_hour')->nullable();
            $table->text('description_th')->nullable();
            $table->text('description_en')->nullable();

            // Domain fields
            $table->string('faccode')->nullable()->index();

            // Ingestion fields
            if (!Schema::hasColumn('courses', 'data_source_id')) {
                $table->foreignId('data_source_id')->nullable()->constrained('data_sources')->onDelete('cascade');
            }
            if (!Schema::hasColumn('courses', 'data_id')) {
                $table->string('data_id')->nullable();
            }
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
