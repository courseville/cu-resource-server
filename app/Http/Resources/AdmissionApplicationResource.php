<?php

namespace App\Http\Resources;

use App\Models\Resources\AdmissionApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property AdmissionApplication $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
