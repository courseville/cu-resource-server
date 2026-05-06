<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentApplicationResource extends JsonResource
{
    /** @property StudentApplication $resource */
    public function toArray(Request $request): array
    {
        return [
            'application_id' => $this->application_id,
            'citizen_id' => $this->citizen_id,
            'transcript_title' => $this->transcript_title,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'student_type' => $this->student_type,
        ];
    }
}
