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
        // after syntax not working with postgresql
        Schema::table('personnels', function (Blueprint $table) {
            $table->string('public_email')->nullable()->after('last_name_en');
            $table->string('private_email')->nullable()->after('public_email');
            $table->string('phone_no')->nullable()->after('private_email');
            $table->string('telephone_no')->nullable()->after('phone_no');
            $table->string('website')->nullable()->after('telephone_no');
            $table->string('building')->nullable()->after('website');
            $table->string('floor')->nullable()->after('building');
            $table->string('room')->nullable()->after('floor');
            $table->text('registered_address')->nullable()->after('room');
            $table->string('registered_sub_district')->nullable()->after('registered_address');
            $table->string('registered_district')->nullable()->after('registered_sub_district');
            $table->string('registered_province')->nullable()->after('registered_district');
            $table->string('registered_postal_code')->nullable()->after('registered_province');
            $table->text('current_address')->nullable()->after('registered_postal_code');
            $table->string('current_sub_district')->nullable()->after('current_address');
            $table->string('current_district')->nullable()->after('current_sub_district');
            $table->string('current_province')->nullable()->after('current_district');
            $table->string('current_postal_code')->nullable()->after('current_province');
            $table->string('passport_no')->nullable()->after('current_postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personnels', function (Blueprint $table) {
            $table->dropColumn('public_email');
            $table->dropColumn('private_email');
            $table->dropColumn('phone_no');
            $table->dropColumn('telephone_no');
            $table->dropColumn('website');
            $table->dropColumn('building');
            $table->dropColumn('floor');
            $table->dropColumn('room');
            $table->dropColumn('registered_address');
            $table->dropColumn('registered_sub_district');
            $table->dropColumn('registered_district');
            $table->dropColumn('registered_province');
            $table->dropColumn('registered_postal_code');
            $table->dropColumn('current_address');
            $table->dropColumn('current_sub_district');
            $table->dropColumn('current_district');
            $table->dropColumn('current_province');
            $table->dropColumn('current_postal_code');
            $table->dropColumn('passport_no');
        });
    }
};
