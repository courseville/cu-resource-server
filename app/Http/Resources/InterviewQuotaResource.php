<?php

namespace App\Http\Resources;

use App\Models\Resources\InterviewQuota;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewQuotaResource extends JsonResource
{
    /** @property InterviewQuota $resource */
    public function toArray(Request $request): array
    {
        return [
            'application_id' => $this->application_id,
            'interviewer_id' => $this->interviewer_id,
        ];
    }
}
