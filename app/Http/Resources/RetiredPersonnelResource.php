<?php

namespace App\Http\Resources;

use App\Models\Resources\RetiredPersonnel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RetiredPersonnelResource extends JsonResource
{
    /** @property RetiredPersonnel $resource */
    public function toArray(Request $request): array
    {
        return [
            'personnel_id' => $this->personnel_id,
            'retired_id' => $this->retired_id,
            'date' => $this->date,
            'type' => $this->type,
            'citizen_id' => $this->citizen_id,
        ];
    }
}
