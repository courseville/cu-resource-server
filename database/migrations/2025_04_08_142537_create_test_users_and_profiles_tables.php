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
        if (config('app.env') === 'local') {
            Schema::create('test_users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('password');
                $table->foreignId('data_source_id')
                    ->constrained('data_sources')
                    ->onDelete('cascade');
                $table->string('data_id')->nullable();
                $table->timestamps();
            });

            Schema::create('test_profiles', function (Blueprint $table) {
                $table->id();
                $table->foreignId('test_user_id')->constrained('test_users')->onDelete('cascade');
                $table->text('bio')->nullable();
                $table->string('avatar')->nullable();
                $table->foreignId('data_source_id')
                    ->constrained('data_sources')
                    ->onDelete('cascade');
                $table->string('data_id')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_profiles');
        Schema::dropIfExists('test_users');
    }
};
