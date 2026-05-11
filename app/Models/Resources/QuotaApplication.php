<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class QuotaApplication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'quota_application';

    protected $fillable = [
        'sync_meta',
        'application_id',
        'portfolio',
        'signature',
        'email',
        'phone_number',
        'picture',
        'intro_video',
        'house_reg',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    public function application()
    {
        return $this->belongsTo(StudentApplication::class);
    }
}
