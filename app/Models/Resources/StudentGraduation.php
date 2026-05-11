<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use App\Traits\HasSyncMeta;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentGraduation extends Model implements Auditable
{
    use HasDomainScope, HasSyncMeta, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'acad_year',
        'semester',
        'student_code',
        'name_thai',
        'name_english',
        'major_thai',
        'major_english',
        'degree_thai',
        'degree_english',
        'graduate_date',
        'concil_date',
        'distinction',
        'faccode',
        'depcode',
        'majorcode',
        'data_source_id',
        'sync_meta',
        'data_id',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
