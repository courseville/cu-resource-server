<?php

namespace App\Http\Resources;

use App\Models\Resources\CourseInstructor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseInstructorResource extends JsonResource
{
    /** @property CourseInstructor $resource */
    public function toArray(Request $request): array
    {
        return [
            'acad_year' => $this->acad_year,
            'semester' => $this->semester,
            'course_code' => $this->course_code,
            'row_seq' => $this->row_seq,
            'section' => $this->section,
            'instructor_no' => $this->instructor_no,
            'prename_code' => $this->prename_code,
            'prename_describe' => $this->prename_describe,
            'title_code' => $this->title_code,
            'title_describe' => $this->title_describe,
            'position' => $this->position,
            'name_thai' => $this->name_thai,
            'surname_thai' => $this->surname_thai,
            'name_english' => $this->name_english,
            'surname_english' => $this->surname_english,
            'name_abbr' => $this->name_abbr,
            'sex' => $this->sex,
            'faccode' => $this->faccode,
            'depcode' => $this->depcode,
        ];
    }
}
