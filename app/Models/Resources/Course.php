<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\HasDomainScope;

class Course extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasDomainScope;

    protected $fillable = [
        'name',
        'description',
        'code',
        'credits',
        'course_id',
        'program_id',
        'type_code',
        'program_group_id',
        'course_no',
        'revision_year',
        'name_th',
        'name_en',
        'name_abbr',
        'l_credit',
        'nl_credit',
        'l_hour',
        'nl_hour',
        's_hour',
        'description_th',
        'description_en',
        'faccode',
        'data_source_id',
        'data_id',
    ];
}
