<?php

namespace App\Http\Resources;

use App\Models\Resources\AcademicProgram;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademicProgramResource extends JsonResource
{
    /** @property AcademicProgram $resource */
    public function toArray(Request $request): array
    {
        return [
            'oaa_program_id' => $this->oaa_program_id,
            'ops_no' => $this->ops_no,
            'program_name_th' => $this->program_name_th,
            'program_name_en' => $this->program_name_en,
            'title_degree_th' => $this->title_degree_th,
            'title_degree_en' => $this->title_degree_en,
            'degree_name_th' => $this->degree_name_th,
            'degree_name_en' => $this->degree_name_en,
            'level_code' => $this->level_code,
            'faculty_code' => $this->faculty_code,
        ];
    }
}
