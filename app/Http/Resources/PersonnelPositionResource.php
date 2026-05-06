<?php

namespace App\Http\Resources;

use App\Models\Resources\PersonnelPosition;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelPositionResource extends JsonResource
{
    /** @property PersonnelPosition $resource */
    public function toArray(Request $request): array
    {
        return [
            'personnel_id' => $this->personnel_id,
            'begin_date' => $this->begin_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'positiontype_id' => $this->positiontype_id,
            'positiontype_name' => $this->positiontype_name,
            'positiontype_text' => $this->positiontype_text,
            'fieldstudy' => $this->fieldstudy,
            'subdiscipline_1' => $this->subdiscipline_1,
            'subdiscipline_2' => $this->subdiscipline_2,
            'subdiscipline_3' => $this->subdiscipline_3,
            'subdiscipline_4' => $this->subdiscipline_4,
            'subdiscipline_5' => $this->subdiscipline_5,
        ];
    }
}
