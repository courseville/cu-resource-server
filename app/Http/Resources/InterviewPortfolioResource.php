<?php

namespace App\Http\Resources;

use App\Models\Resources\InterviewPortfolio;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewPortfolioResource extends JsonResource
{
    /** @property InterviewPortfolio $resource */
    public function toArray(Request $request): array
    {
        return [
            'application_id' => $this->application_id,
            'interviewer_id' => $this->interviewer_id,
        ];
    }
}
