<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentStatusHistory extends Model implements Auditable
{
    use HasDomainScope, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'student_code',
        'name_thai',
        'name_english',
        'status',
        'effect_date',
        'from_acad_year',
        'from_semester',
        'to_acad_year',
        'to_semester',
        'instruction_no',
        'announcement',
        'faccode',
        'depcode',
        'majorcode',
        'data_source_id',
        'data_id',
    ];
}
