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
            'structure_profiles' => StructureProfileResource::collection($this->whenLoaded('structureProfiles')),
        ];
    }
}
