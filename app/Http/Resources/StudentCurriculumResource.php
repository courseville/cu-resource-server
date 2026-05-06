<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentCurriculum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCurriculumResource extends JsonResource
{
    /** @property StudentCurriculum $resource */
    public function toArray(Request $request): array
    {
        return [
            'year' => $this->year,
            'semester' => $this->semester,
            'student_code' => $this->student_code,
            'name_thai' => $this->name_thai,
            'name_english' => $this->name_english,
            'course_code' => $this->course_code,
            'course_name' => $this->course_name,
            'section' => $this->section,
            'grade' => $this->grade,
            'credit_tot' => $this->credit_tot,
            'faccode' => $this->faccode,
            'depcode' => $this->depcode,
            'majorcode' => $this->majorcode,
        ];
    }
}
