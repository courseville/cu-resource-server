<?php

namespace App\Http\Resources;

use App\Models\Resources\AdmissionApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionApplicationResource extends JsonResource
{
    /** @property AdmissionApplication $resource */
    public function toArray(Request $request): array
    {
        return [
            'application_id' => $this->application_id,
            'school' => $this->school,
            'score' => $this->score,
        ];
    }
}
