<?php

namespace App\Http\Resources;

use App\Models\Resources\GrantDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrantDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property GrantDetail $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
