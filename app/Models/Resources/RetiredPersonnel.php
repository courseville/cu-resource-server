<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSyncMeta;
use OwenIt\Auditing\Contracts\Auditable;

class RetiredPersonnel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'retired_personnel';

    protected $fillable = [
        'sync_meta',
        'personnel_id',
        'retired_id',
        'date',
        'type',
        'citizen_id',
    ];

    protected $casts = [
        'sync_meta' => 'json',
        'date' => 'datetime',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
