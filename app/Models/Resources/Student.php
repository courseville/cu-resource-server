<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use App\Traits\HasDomainScope;

class Student extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasDomainScope;

    protected $fillable = [
        'student_id',
        'title_th',
        'first_name_th',
        'last_name_th',
        'full_name_th',
        'title_en',
        'first_name_en',
        'last_name_en',
        'full_name_en',
        'faccode',
        'depcode',
        'course_code_no',
        'faculty_group',
        'major_code',
        'program_code',
        'study_program_system',
        'project_code',
        'start_acad_year',
        'start_semester',
        'max_period',
        'min_period',
        'credit_tot',
        'fac_name',
        'dep_name',
        'major_name',
        'fac_name_eng',
        'dep_name_eng',
        'major_name_eng',
        'data_source_id',
        'data_id',
    ];

    protected $searchable = [
        'first_name_th',
        'last_name_th',
        'first_name_en',
        'last_name_en',
    ];

    public function getSearchable(): array
    {
        return $this->searchable ?? [];
    }
}
