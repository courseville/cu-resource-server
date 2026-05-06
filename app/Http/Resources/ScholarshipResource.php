<?php

namespace App\Http\Resources;

use App\Models\Resources\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScholarshipResource extends JsonResource
{
    /** @property Scholarship $resource */
    public function toArray(Request $request): array
    {
        return [
            'job_code' => $this->job_code,
            'fcode' => $this->fcode,
            'scholarship_name' => $this->scholarship_name,
            'name_en' => $this->name_en,
            'description' => $this->description,
            'file' => $this->file,
            'file_description' => $this->file_description,
            'academic_year' => $this->academic_year,
            'isactive' => $this->isactive,
            'update_by' => $this->update_by,
            'require_doc' => $this->require_doc,
            'require_app1' => $this->require_app1,
            'require_app2' => $this->require_app2,
            'can_assign' => $this->can_assign,
            'date_update' => $this->date_update,
        ];
    }
}
