<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\HasDomainScope;

class StudentGraduation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasDomainScope;

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
        'data_id',
    ];
}
