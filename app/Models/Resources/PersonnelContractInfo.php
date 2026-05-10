<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSyncMeta;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelContractInfo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
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
        'position_name',
        'position_number',
        'contract_type_id',
        'contract_type_name',
        'contract_end_date',
        'btrtl',
        'btrtl_text',
        'stell',
        'stell_text',
        'organization_id',
        'organization_name',
        'structure_level1_name',
        'structure_level2_name',
        'structure_level3_name',
        'structure_level4_name'
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
