<?php

namespace App\Http\Resources;

use App\Models\Resources\QuotaApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotaApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property QuotaApplication $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
