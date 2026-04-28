<?php

namespace App\Http\Resources;

use App\Models\Resources\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property Curriculum $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'curriculum_code' => $this->curriculum_code,
            'curriculum_name' => $this->curriculum_name,
            'curriculum_name_en' => $this->curriculum_name_en,
            'department_id' => $this->department_id,
            'department_name' => $this->department_name,
            'faculty_id' => $this->faculty_id,
            'faculty_name' => $this->faculty_name,
            'degree_level' => $this->degree_level,
            'degree_level_name' => $this->degree_level_name,
            'degree_name' => $this->degree_name,
            'year' => $this->year,
        ];
    }
}
