<?php

namespace App\Http\Resources;

use App\Models\Resources\Interviewer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewerResource extends JsonResource
{
    /** @property Interviewer $resource */
    public function toArray(Request $request): array
    {
        return [
            'position_number' => $this->position_number,
            'title' => $this->title,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'signature' => $this->signature,
        ];
    }
}
