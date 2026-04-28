<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CourseSchedule extends Model implements Auditable
{
    use HasDomainScope, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'year',
        'semester',
        'course_code',
        'course_name',
        'section',
        'row_seq',
        'teach_type',
        'day1',
        'day2',
        'day3',
        'day4',
        'day5',
        'day6',
        'day7',
        'start_time',
        'end_time',
        'building',
        'room',
        'study_program_system',
        'gen_ed_status',
        'general_subject',
        'lecture_credit',
        'non_lecture_credit',
        'total_credit',
        'real_reg',
        'total_reg',
        'remark1',
        'remark2',
        'remark3',
        'faccode',
        'data_source_id',
        'data_id',
    ];
}
