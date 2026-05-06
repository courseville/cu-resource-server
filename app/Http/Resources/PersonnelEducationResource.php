<?php

namespace App\Http\Resources;

use App\Models\Resources\PersonnelEducation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelEducationResource extends JsonResource
{
    /** @property PersonnelEducation $resource */
    public function toArray(Request $request): array
    {
        return [
            'personnel_id' => $this->personnel_id,
            'begin_date' => $this->begin_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'education_level_id' => $this->education_level_id,
            'education_level_name' => $this->education_level_name,
            'institution_id' => $this->institution_id,
            'institution_name' => $this->institution_name,
            'major_id' => $this->major_id,
            'major_name' => $this->major_name,
            'degree_id' => $this->degree_id,
            'degree_name' => $this->degree_name,
            'nation_id' => $this->nation_id,
            'nation_name_th' => $this->nation_name_th,
            'distinction_id' => $this->distinction_id,
            'distinction_name' => $this->distinction_name,
            'highest_education' => $this->highest_education,
            'highest_education_th' => $this->highest_education_th,
            'employ_education_id' => $this->employ_education_id,
            'employ_education_name' => $this->employ_education_name,
            'graduate_date' => $this->graduate_date?->toDateString(),
        ];
    }
}
