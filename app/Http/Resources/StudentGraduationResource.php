<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentGraduation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentGraduationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property StudentGraduation $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
