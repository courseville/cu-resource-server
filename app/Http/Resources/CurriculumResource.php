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
            'curriculum_code' => $this->course_code_no,
            'curriculum_name' => implode(' ', array_filter([
                trim($this->degree ?? ''),
                trim($this->major ?? ''),
                trim($this->calendar ?? ''),
            ], static fn(string $part): bool => $part !== '')),
            'department_id' => $this->depcode,
            'faculty_id' => $this->faccode,
            'degree_level' => $this->plan1,
            'degree_name' => $this->degree,
            'year' => $this->begin_year,
        ];
    }
}