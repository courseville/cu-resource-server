<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelAction extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'personnel_id',
        'begin_date',
        'end_date',
        'status_id',
        'status_name',
        'action_id',
        'action_name',
        'reason_id',
        'reason_name',
        'modify_user',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
