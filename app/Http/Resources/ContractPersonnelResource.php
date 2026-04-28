<?php

namespace App\Http\Resources;

use App\Models\Resources\ContractPersonnel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractPersonnelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property ContractPersonnel $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
