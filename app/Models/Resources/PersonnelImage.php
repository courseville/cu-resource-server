<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSyncMeta;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelImage extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'personnel_id',
        'citizen_id',
        'passport_number',
        'image_name',
        'begin_date'
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
