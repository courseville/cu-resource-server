<?php

namespace App\Http\Resources;

use App\Models\Resources\Personnel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property Personnel $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'personnel_id' => $this->personnel_id,
            'title_th' => $this->title_th,
            'first_name_th' => $this->first_name_th,
            'last_name_th' => $this->last_name_th,
            'title_en' => $this->title_en,
            'first_name_en' => $this->first_name_en,
            'last_name_en' => $this->last_name_en,
            'public_email' => $this->public_email,
            'private_email' => $this->private_email,
            'phone_no' => $this->phone_no,
            'telephone_no' => $this->telephone_no,
            'website' => $this->website,
            'building' => $this->building,
            'floor' => $this->floor,
            'room' => $this->room,
            'registered_address' => $this->registered_address,
            'registered_sub_district' => $this->registered_sub_district,
            'registered_district' => $this->registered_district,
            'registered_province' => $this->registered_province,
            'registered_postal_code' => $this->registered_postal_code,
            'current_address' => $this->current_address,
            'current_sub_district' => $this->current_sub_district,
            'current_district' => $this->current_district,
            'current_province' => $this->current_province,
            'current_postal_code' => $this->current_postal_code,
            'passport_no' => $this->passport_no,
            'rank_title' => $this->rank_title,
            'doctoral_title' => $this->doctoral_title,
            'acad_title_1' => $this->acad_title_1,
            'acad_title_2' => $this->acad_title_2,
            'title_by_the_king' => $this->title_by_the_king,
            'full_title' => $this->full_title,
            'faccode' => $this->faccode,
            'depcode' => $this->depcode,
            // 'academic_position' => $this->academic_position,
            'citizen_id' => $this->citizen_id,
            'birth_date' => $this->birth_date?->toDateString(),
            'marital_status' => $this->marital_status,
            'department' => $this->department,
            'personnel_status' => $this->personnel_status,
            'personnel_type' => $this->personnel_type,
            'status_change_date' => $this->status_change_date?->toDateString(),
            'personnel_group' => $this->personnel_group,
            'personnel_subgroup' => $this->personnel_subgroup,
            'position_name' => $this->position_name,
            'position_number' => $this->position_number,
            'position_appointment_date' => $this->position_appointment_date?->toDateString(),
            'start_date' => $this->start_date?->toDateString(),
            'transformation_date' => $this->transformation_date?->toDateString(),
            'structure_level1_name' => $this->structure_level1_name,
            'structure_level2_name' => $this->structure_level2_name,
            'structure_level3_name' => $this->structure_level3_name,
            'structure_level4_name' => $this->structure_level4_name,
            'educations' => PersonnelEducationResource::collection($this->whenLoaded('educations')),
            'positions' => PersonnelPositionResource::collection($this->whenLoaded('positions')),
            'student_advisors' => $this->whenLoaded('studentAdvisors', fn () => $this->studentAdvisors->pluck('student_id')),
        ];
    }
}
