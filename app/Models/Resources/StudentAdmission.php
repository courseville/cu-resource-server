<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\HasDomainScope;

class StudentAdmission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasDomainScope;

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
