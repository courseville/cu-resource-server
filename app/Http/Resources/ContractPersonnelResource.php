<?php

namespace App\Http\Resources;

use App\Models\Resources\ContractPersonnel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractPersonnelResource extends JsonResource
{
    /** @property ContractPersonnel $resource */
    public function toArray(Request $request): array
    {
        return [
            'personnel_id' => $this->personnel_id,
            'contract_id' => $this->contract_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'detail' => $this->detail,
        ];
    }
}
