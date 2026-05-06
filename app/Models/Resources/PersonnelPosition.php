<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelPosition extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $casts = [
        'begin_date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = [
        'personnel_id',
        'begin_date',
        'end_date',
        'positiontype_id',
        'positiontype_name',
        'positiontype_text',
        'fieldstudy',
        'subdiscipline_1',
        'subdiscipline_2',
        'subdiscipline_3',
        'subdiscipline_4',
        'subdiscipline_5'
    ];
}
