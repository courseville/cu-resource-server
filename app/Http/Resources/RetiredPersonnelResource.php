<?php

namespace App\Http\Resources;

use App\Models\Resources\RetiredPersonnel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RetiredPersonnelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property RetiredPersonnel $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
