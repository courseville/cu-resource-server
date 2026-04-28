<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentAdmission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentAdmissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property StudentAdmission $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
