<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSyncMeta;
use OwenIt\Auditing\Contracts\Auditable;

class StudentApplication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'application_id',
        'citizen_id',
        'transcript_title',
        'first_name',
        'last_name',
        'student_type',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
