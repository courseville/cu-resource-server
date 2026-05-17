<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Faculty extends Model implements Auditable
{
    use \App\Traits\HasSyncMeta;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'faccode',
        'name_th',
        'name_en',
        'sync_meta',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
