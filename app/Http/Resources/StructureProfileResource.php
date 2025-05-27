<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StructureProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'structureLevel1' => new StructureResource($this->whenLoaded('structureLevel1')),
            'structureLevel2' => new StructureResource($this->whenLoaded('structureLevel2')),
            'structureLevel3' => new StructureResource($this->whenLoaded('structureLevel3')),
            'structureLevel4' => new StructureResource($this->whenLoaded('structureLevel4')),
        ];
    }
}
