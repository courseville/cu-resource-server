<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\HasDomainScope;

class AcademicProgram extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasDomainScope;

    protected $fillable = [
        'oaa_program_id',
        'ops_no',
        'program_name_th',
        'program_name_en',
        'title_degree_th',
        'title_degree_en',
        'degree_name_th',
        'degree_name_en',
        'level_code',
        'faculty_code',
        'data_source_id',
        'data_id',
    ];
}
