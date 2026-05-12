<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class StudentAdvisor extends Model implements Auditable
{
    use \App\Traits\HasSyncMeta;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'student_id',
        'staff_id',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
