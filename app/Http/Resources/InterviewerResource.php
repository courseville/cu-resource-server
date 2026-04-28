<?php

namespace App\Http\Resources;

use App\Models\Resources\Interviewer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property Interviewer $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
