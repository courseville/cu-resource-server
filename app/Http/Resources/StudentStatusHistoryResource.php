<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentStatusHistoryResource extends JsonResource
{
    /** @property StudentStatusHistory $resource */
    public function toArray(Request $request): array
    {
        return [
            'student_code' => $this->student_code,
            'name_thai' => $this->name_thai,
            'name_english' => $this->name_english,
            'status' => $this->status,
            'effect_date' => $this->effect_date,
            'from_acad_year' => $this->from_acad_year,
            'from_semester' => $this->from_semester,
            'to_acad_year' => $this->to_acad_year,
            'to_semester' => $this->to_semester,
            'instruction_no' => $this->instruction_no,
            'announcement' => $this->announcement,
            'faccode' => $this->faccode,
            'depcode' => $this->depcode,
            'majorcode' => $this->majorcode,
        ];
    }
}
