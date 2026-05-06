<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->string('job_code')->nullable()->unique()->after('id');
            $table->string('fcode')->nullable()->after('job_code');
            $table->string('name_en')->nullable()->after('scholarship_name');
            $table->boolean('isactive')->nullable()->after('academic_year');
            $table->string('update_by')->nullable()->after('isactive');
            $table->boolean('require_doc')->nullable()->after('update_by');
            $table->boolean('require_app1')->nullable()->after('require_doc');
            $table->boolean('require_app2')->nullable()->after('require_app1');
            $table->boolean('can_assign')->nullable()->after('require_app2');
            $table->timestamp('date_update')->nullable()->after('can_assign');
        });
    }

    public function down(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->dropColumn([
                'job_code', 'fcode', 'name_en', 'isactive', 'update_by',
                'require_doc', 'require_app1', 'require_app2', 'can_assign', 'date_update',
            ]);
        });
    }
};
