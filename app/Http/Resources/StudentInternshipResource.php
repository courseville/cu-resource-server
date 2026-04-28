<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentInternship;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentInternshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property StudentInternship $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
