<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\HasDomainScope;

class StudentCurriculum extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasDomainScope;

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
