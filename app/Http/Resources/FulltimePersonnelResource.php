<?php

namespace App\Http\Resources;

use App\Models\Resources\FulltimePersonnel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FulltimePersonnelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property FulltimePersonnel $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
