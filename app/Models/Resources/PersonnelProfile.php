<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelProfile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'personnel_id',
        'begin_date',
        'end_date',
        'title_id',
        'title_th',
        'name_th',
        'surname_th',
        'gender',
        'birth_date',
        'rank_title',
        'doctoral_title',
        'acad_title_1',
        'acad_title_2',
        'title_by_the_king',
        'nation',
        'marrital_status',
        'email',
        'title_en',
        'name_en',
        'surname_en',
        'citizen_id',
        'passport_number',
        'office_phonenumber',
        'full_title',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
