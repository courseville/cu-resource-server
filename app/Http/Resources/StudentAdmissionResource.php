<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentAdmission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentAdmissionResource extends JsonResource
{
    /** @property StudentAdmission $resource */
    public function toArray(Request $request): array
    {
        return [
            'student_code' => $this->student_code,
            'name_thai' => $this->name_thai,
            'name_english' => $this->name_english,
            'faccode' => $this->faccode,
            'depcode' => $this->depcode,
            'majorcode' => $this->majorcode,
            'admission_type' => $this->admission_type,
            'apply_year' => $this->apply_year,
            'apply_semester' => $this->apply_semester,
            'apply_date' => $this->apply_date,
            'apply_status' => $this->apply_status,
        ];
    }
}
