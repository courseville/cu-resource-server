<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Department extends Model implements Auditable
{
    use \App\Traits\HasSyncMeta;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'depcode',
        'name_th',
        'name_en',
        'sync_meta',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
