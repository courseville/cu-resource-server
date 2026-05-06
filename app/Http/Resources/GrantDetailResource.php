<?php

namespace App\Http\Resources;

use App\Models\Resources\GrantDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrantDetailResource extends JsonResource
{
    /** @property GrantDetail $resource */
    public function toArray(Request $request): array
    {
        return [
            'student_id' => $this->student_id,
            'type' => $this->type,
            'travel_cost' => $this->travel_cost,
            'accommodation_cost' => $this->accommodation_cost,
            'lump_sum_allowance' => $this->lump_sum_allowance,
            'first_student_id' => $this->first_student_id,
            'second_student_id' => $this->second_student_id,
        ];
    }
}
