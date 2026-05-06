<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelEducation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'personnel_education';

    protected $casts = [
        'begin_date' => 'date',
        'end_date' => 'date',
        'graduate_date' => 'date',
    ];
    protected $fillable = [
        'personnel_id',
        'begin_date',
        'end_date',
        'education_level_id',
        'education_level_name',
        'institution_id',
        'institution_name',
        'major_id',
        'major_name',
        'degree_id',
        'degree_name',
        'nation_id',
        'nation_name_th',
        'distinction_id',
        'distinction_name',
        'highest_education',
        'highest_education_th',
        'employ_education_id',
        'employ_education_name',
        'graduate_date'
    ];
}
