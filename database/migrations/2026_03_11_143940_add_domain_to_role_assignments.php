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
        Schema::table('role_user', function (Blueprint $table) {
            $table->string('domain')->nullable()->comment('Faculty or department code for scoping');
        });

        Schema::table('oauth_client_role', function (Blueprint $table) {
            $table->string('domain')->nullable()->comment('Faculty or department code for scoping');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->dropColumn('domain');
        });

        Schema::table('oauth_client_role', function (Blueprint $table) {
            $table->dropColumn('domain');
        });
    }
};
