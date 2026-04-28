<?php

namespace App\Http\Resources;

use App\Models\Resources\ProgramCommittee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramCommitteeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property ProgramCommittee $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
