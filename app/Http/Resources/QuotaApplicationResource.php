<?php

namespace App\Http\Resources;

use App\Models\Resources\QuotaApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotaApplicationResource extends JsonResource
{
    /** @property QuotaApplication $resource */
    public function toArray(Request $request): array
    {
        return [
            'application_id' => $this->application_id,
            'portfolio' => $this->portfolio,
            'signature' => $this->signature,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'picture' => $this->picture,
            'intro_video' => $this->intro_video,
            'house_reg' => $this->house_reg,
        ];
    }
}
