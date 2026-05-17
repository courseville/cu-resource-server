<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentGrade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentGradeResource extends JsonResource
{
    /** @property StudentGrade $resource */
    public function toArray(Request $request): array
    {
        return [
            'student_code' => $this->student_code,
            'year' => $this->year,
            'semester' => $this->semester,
            'course_code' => $this->course_code,
            'total_credit' => $this->total_credit,
            'grade' => $this->grade,
            'last_update' => $this->last_update,
            'faccode' => $this->faccode,
            'depcode' => $this->depcode,
            'majorcode' => $this->majorcode,
        ];
    }
}
