<?php

namespace App\Http\Resources;

use App\Models\Resources\InterviewPortfolio;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewPortfolioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property InterviewPortfolio $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
