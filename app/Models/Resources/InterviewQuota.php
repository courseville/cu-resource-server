<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class InterviewQuota extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'interview_quota';

    protected $fillable = [
        'sync_meta',
        'application_id',
        'interviewer_id',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    public function application()
    {
        return $this->belongsTo(StudentApplication::class);
    }

    public function interviewer()
    {
        return $this->belongsTo(Interviewer::class);
    }
}
