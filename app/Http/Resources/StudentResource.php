<?php

namespace App\Http\Resources;

use App\Models\Resources\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /** @property Student $resource */
    public function toArray(Request $request): array
    {
        return [
            'student_id' => $this->student_id,
            'title_th' => $this->title_th,
            'first_name_th' => $this->first_name_th,
            'last_name_th' => $this->last_name_th,
            'full_name_th' => $this->full_name_th,
            'title_en' => $this->title_en,
            'first_name_en' => $this->first_name_en,
            'last_name_en' => $this->last_name_en,
            'full_name_en' => $this->full_name_en,
            'faccode' => $this->faccode,
            'depcode' => $this->depcode,
            'course_code_no' => $this->course_code_no,
            'faculty_group' => $this->faculty_group,
            'major_code' => $this->major_code,
            'program_code' => $this->program_code,
            'study_program_system' => $this->study_program_system,
            'project_code' => $this->project_code,
            'start_acad_year' => $this->start_acad_year,
            'start_semester' => $this->start_semester,
            'max_period' => $this->max_period,
            'min_period' => $this->min_period,
            'credit_tot' => $this->credit_tot,
            'fac_name' => $this->fac_name,
            'dep_name' => $this->dep_name,
            'major_name' => $this->major_name,
            'fac_name_eng' => $this->fac_name_eng,
            'dep_name_eng' => $this->dep_name_eng,
            'major_name_eng' => $this->major_name_eng,
            'reg_code' => $this->reg_code,
        ];
    }
}
