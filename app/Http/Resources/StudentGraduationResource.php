<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentGraduation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentGraduationResource extends JsonResource
{
    /** @property StudentGraduation $resource */
    public function toArray(Request $request): array
    {
        return [
            'acad_year' => $this->acad_year,
            'semester' => $this->semester,
            'student_code' => $this->student_code,
            'name_thai' => $this->name_thai,
            'name_english' => $this->name_english,
            'major_thai' => $this->major_thai,
            'major_english' => $this->major_english,
            'degree_thai' => $this->degree_thai,
            'degree_english' => $this->degree_english,
            'graduate_date' => $this->graduate_date,
            'concil_date' => $this->concil_date,
            'distinction' => $this->distinction,
            'faccode' => $this->faccode,
            'depcode' => $this->depcode,
            'majorcode' => $this->majorcode,
        ];
    }
}
