<?php

namespace App\Http\Resources;

use App\Models\Resources\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /** @property Course $resource */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'code' => $this->code,
            'credits' => $this->credits,
            'course_id' => $this->course_id,
            'program_id' => $this->program_id,
            'type_code' => $this->type_code,
            'program_group_id' => $this->program_group_id,
            'course_no' => $this->course_no,
            'revision_year' => $this->revision_year,
            'name_th' => $this->name_th,
            'name_en' => $this->name_en,
            'name_abbr' => $this->name_abbr,
            'l_credit' => $this->l_credit,
            'nl_credit' => $this->nl_credit,
            'l_hour' => $this->l_hour,
            'nl_hour' => $this->nl_hour,
            's_hour' => $this->s_hour,
            'description_th' => $this->description_th,
            'description_en' => $this->description_en,
            'faccode' => $this->faccode,
        ];
    }
}
