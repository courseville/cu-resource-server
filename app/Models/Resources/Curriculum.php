<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\HasDomainScope;

class Curriculum extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasDomainScope;

    protected $table = 'curriculums';

    protected $fillable = [
        'course_code_no',
        'major_code',
        'degree',
        'major',
        'no_year_study',
        'plan1',
        'language1',
        'program_system',
        'calendar',
        'begin_year',
        'begin_semester',
        'faccode',
        'depcode',
        'data_source_id',
        'data_id',
    ];
}
