<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentAdvisor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentAdvisorResource extends JsonResource
{
    /** @property StudentAdvisor $resource */
    public function toArray(Request $request): array
    {
        return [
            'student_id' => $this->student_id,
            'staff_id' => $this->staff_id,
        ];
    }
}
