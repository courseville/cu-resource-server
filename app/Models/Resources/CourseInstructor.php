<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CourseInstructor extends Model implements Auditable
{
    use HasDomainScope, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'acad_year',
        'semester',
        'course_code',
        'row_seq',
        'section',
        'instructor_no',
        'prename_code',
        'prename_describe',
        'title_code',
        'title_describe',
        'position',
        'name_thai',
        'surname_thai',
        'name_english',
        'surname_english',
        'name_abbr',
        'sex',
        'faccode',
        'depcode',
        'data_source_id',
        'data_id',
    ];
}
