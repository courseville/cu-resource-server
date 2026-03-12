<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentCurriculum extends Model implements Auditable
{
    use HasDomainScope, \OwenIt\Auditing\Auditable;

    protected $table = 'student_curriculums';

    protected $fillable = [
        'year',
        'semester',
        'student_code',
        'name_thai',
        'name_english',
        'course_code',
        'course_name',
        'section',
        'grade',
        'credit_tot',
        'faccode',
        'depcode',
        'majorcode',
        'data_source_id',
        'data_id',
    ];
}
