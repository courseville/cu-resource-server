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
            'structure_level_1' => new StructureResource($this->whenLoaded('structureLevel1')),
            'structure_level_2' => new StructureResource($this->whenLoaded('structureLevel2')),
            'structure_level_3' => new StructureResource($this->whenLoaded('structureLevel3')),
            'structure_level_4' => new StructureResource($this->whenLoaded('structureLevel4')),
        ];
    }
}
