<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSyncMeta;
use OwenIt\Auditing\Contracts\Auditable;

class StudentInternship extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'student_id',
        'intern_year',
        'process_step',
        'status',
        'grant',
        'file',
        'address_pic',
        'start_date',
        'end_date',
        'location_address',
        'location_city',
        'location_name',
        'job_description',
        'sup_name',
        'sup_position',
        'sup_phone',
        'company',
        'comp_addr',
        'comp_admin',
        'comp_title',
        'comp_tel',
        'flag_comp_status',
        'flag_req_change',
        'date_comp_regist',
        'date_comp_book',
        'date_comp_book_rec',
        'date_comp_accept',
        'prac_lon',
        'prac_lat',
        'prac_loc1',
        'prac_loc2',
        'prac_datechange_status',
        'prac_score',
        'prac_score_p',
        'report1_date',
        'report1_score',
        'report1_score_p',
        'report2_date',
        'report2_score',
        'report2_score_p',
        'report3_date',
        'report3_score',
        'report3_score_p',
        'report4_date',
        'report4_score',
        'report4_score_p',
        'report5_date',
        'report5_score',
        'report5_score_p',
        'reportf_date',
        'reportf_score',
        'reportf_score_p',
        'reportf_score_p_date',
        'date_prac_create',
        'date_prac_update',
        'allowance',
        'assess_comp',
        'assess_receive_date',
        'assess_by',
        'assess_type',
        'assess_date',
        'assess_score',
        'flag_last_reportw',
        'blacklist',
        'grade',
        'date_create',
    ];

    protected $casts = [
        'sync_meta' => 'json',
        'flag_req_change' => 'boolean',
        'blacklist' => 'boolean',
        'grant' => 'boolean',
        'date_comp_regist' => 'datetime',
        'date_comp_book' => 'datetime',
        'date_comp_book_rec' => 'datetime',
        'date_comp_accept' => 'datetime',
        'report1_date' => 'datetime',
        'report2_date' => 'datetime',
        'report3_date' => 'datetime',
        'report4_date' => 'datetime',
        'report5_date' => 'datetime',
        'reportf_date' => 'datetime',
        'reportf_score_p_date' => 'datetime',
        'date_prac_create' => 'datetime',
        'date_prac_update' => 'datetime',
        'assess_receive_date' => 'datetime',
        'assess_date' => 'datetime',
        'date_create' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
