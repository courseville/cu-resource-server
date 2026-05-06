<?php

namespace App\Http\Resources;

use App\Models\Resources\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    /** @property Portfolio $resource */
    public function toArray(Request $request): array
    {
        return [
            'application_id' => $this->application_id,
            'signature' => $this->signature,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'picture' => $this->picture,
            'intro_video' => $this->intro_video,
            'work' => $this->work,
        ];
    }
}
