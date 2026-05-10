<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSyncMeta;
use OwenIt\Auditing\Contracts\Auditable;

class Portfolio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'application_id',
        'signature',
        'email',
        'phone_number',
        'picture',
        'intro_video',
        'work',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    public function application()
    {
        return $this->belongsTo(StudentApplication::class);
    }
}
