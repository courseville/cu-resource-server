<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentGrade extends Model implements Auditable
{
    use \App\Traits\HasDomainScope, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'sync_meta',
        'student_code',
        'year',
        'semester',
        'course_code',
        'total_credit',
        'grade',
        'last_update',
        'faccode',
        'depcode',
        'majorcode',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
