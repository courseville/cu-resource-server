<?php

namespace App\Http\Resources;

use App\Models\Resources\FulltimePersonnel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FulltimePersonnelResource extends JsonResource
{
    /** @property FulltimePersonnel $resource */
    public function toArray(Request $request): array
    {
        return [
            'personnel_id' => $this->personnel_id,
            'full_time_id' => $this->full_time_id,
            'university' => $this->university,
            'degree' => $this->degree,
            'education_level' => $this->education_level,
            'date_of_appointment' => $this->date_of_appointment,
            'asst_prof_date' => $this->asst_prof_date,
            'prof_date' => $this->prof_date,
            'assoc_prof_date' => $this->assoc_prof_date,
            'birth_date' => $this->birth_date,
            'age' => $this->age,
            'personnel_status_changing_date' => $this->personnel_status_changing_date,
            'salary_band' => $this->salary_band,
            'teacher_date' => $this->teacher_date,
            'job_type' => $this->job_type,
        ];
    }
}
