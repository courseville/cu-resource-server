<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelRetired extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'personnel_id',
        'begin_date',
        'end_date',
        'status_id',
        'title_th',
        'name_th',
        'surname_th',
        'title_en',
        'name_en',
        'surname_en',
        'email',
        'nation',
        'citizen_id',
        'passport_number',
        'staff_group',
        'personnel_grp_id',
        'personnel_grp_name',
        'personnel_subgrp_name',
        'position_name',
        'position_number',
        'btrtl',
        'btrtl_text',
        'stell',
        'stell_text',
        'ansvh',
        'ansvh_text',
        'structure_level1_name',
        'structure_level2_name',
        'structure_level3_name',
        'structure_level4_name'
    ];
}
