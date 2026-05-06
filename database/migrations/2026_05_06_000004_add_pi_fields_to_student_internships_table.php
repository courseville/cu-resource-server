<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_internships', function (Blueprint $table) {
            $table->integer('intern_year')->nullable()->after('student_id');
            $table->string('comp_addr')->nullable();
            $table->string('comp_admin')->nullable();
            $table->string('comp_title')->nullable();
            $table->string('comp_tel')->nullable();
            $table->string('flag_comp_status')->nullable();
            $table->boolean('flag_req_change')->nullable();
            $table->timestamp('date_comp_regist')->nullable();
            $table->timestamp('date_comp_book')->nullable();
            $table->timestamp('date_comp_book_rec')->nullable();
            $table->timestamp('date_comp_accept')->nullable();
            $table->decimal('prac_lon', 10, 6)->nullable();
            $table->decimal('prac_lat', 10, 6)->nullable();
            $table->string('prac_loc1')->nullable();
            $table->string('prac_loc2')->nullable();
            $table->string('prac_datechange_status')->nullable();
            $table->decimal('prac_score', 5, 2)->nullable();
            $table->string('prac_score_p')->nullable();
            $table->timestamp('report1_date')->nullable();
            $table->decimal('report1_score', 5, 2)->nullable();
            $table->string('report1_score_p')->nullable();
            $table->timestamp('report2_date')->nullable();
            $table->decimal('report2_score', 5, 2)->nullable();
            $table->string('report2_score_p')->nullable();
            $table->timestamp('report3_date')->nullable();
            $table->decimal('report3_score', 5, 2)->nullable();
            $table->string('report3_score_p')->nullable();
            $table->timestamp('report4_date')->nullable();
            $table->decimal('report4_score', 5, 2)->nullable();
            $table->string('report4_score_p')->nullable();
            $table->timestamp('report5_date')->nullable();
            $table->decimal('report5_score', 5, 2)->nullable();
            $table->string('report5_score_p')->nullable();
            $table->timestamp('reportf_date')->nullable();
            $table->decimal('reportf_score', 5, 2)->nullable();
            $table->string('reportf_score_p')->nullable();
            $table->timestamp('reportf_score_p_date')->nullable();
            $table->timestamp('date_prac_create')->nullable();
            $table->timestamp('date_prac_update')->nullable();
            $table->decimal('allowance', 10, 2)->nullable();
            $table->string('assess_comp')->nullable();
            $table->timestamp('assess_receive_date')->nullable();
            $table->string('assess_by')->nullable();
            $table->string('assess_type')->nullable();
            $table->timestamp('assess_date')->nullable();
            $table->decimal('assess_score', 5, 2)->nullable();
            $table->string('flag_last_reportw')->nullable();
            $table->boolean('blacklist')->nullable();
            $table->string('grade')->nullable();
            $table->timestamp('date_create')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student_internships', function (Blueprint $table) {
            $table->dropColumn([
                'intern_year', 'comp_addr', 'comp_admin', 'comp_title', 'comp_tel',
                'flag_comp_status', 'flag_req_change',
                'date_comp_regist', 'date_comp_book', 'date_comp_book_rec', 'date_comp_accept',
                'prac_lon', 'prac_lat', 'prac_loc1', 'prac_loc2',
                'prac_datechange_status', 'prac_score', 'prac_score_p',
                'report1_date', 'report1_score', 'report1_score_p',
                'report2_date', 'report2_score', 'report2_score_p',
                'report3_date', 'report3_score', 'report3_score_p',
                'report4_date', 'report4_score', 'report4_score_p',
                'report5_date', 'report5_score', 'report5_score_p',
                'reportf_date', 'reportf_score', 'reportf_score_p', 'reportf_score_p_date',
                'date_prac_create', 'date_prac_update',
                'allowance', 'assess_comp', 'assess_receive_date', 'assess_by',
                'assess_type', 'assess_date', 'assess_score',
                'flag_last_reportw', 'blacklist', 'grade', 'date_create',
            ]);
        });
    }
};
