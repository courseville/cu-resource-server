<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentAdmission extends Model implements Auditable
{
    use HasDomainScope, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'student_code',
        'name_thai',
        'name_english',
        'faccode',
        'depcode',
        'majorcode',
        'admission_type',
        'apply_year',
        'apply_semester',
        'apply_date',
        'apply_status',
        'data_source_id',
        'data_id',
    ];
}
