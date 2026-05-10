<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSyncMeta;
use OwenIt\Auditing\Contracts\Auditable;

class AdmissionApplication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'admission_application';

    protected $fillable = [
        'sync_meta',
        'application_id',
        'school',
        'score',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    public function application()
    {
        return $this->belongsTo(StudentApplication::class);
    }
}
