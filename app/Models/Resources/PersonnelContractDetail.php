<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelContractDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'personnel_id',
        'begin_date',
        'end_date',
        'contract_type_id',
        'contract_type_name',
        'probation',
        'probation_unit',
        'contract_end_date',
        'disemploy_employer',
        'disemploy_employee',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
