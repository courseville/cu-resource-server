<?php

namespace App\Http\Resources;

use App\Models\Resources\PersonnelSalary;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelSalaryResource extends JsonResource
{
    /** @property PersonnelSalary $resource */
    public function toArray(Request $request): array
    {
        return [
            'personnel_id' => $this->personnel_id,
            'amount' => $this->amount,
            'date' => $this->date,
        ];
    }
}
