<?php

namespace App\Http\Resources;

use App\Models\Resources\CourseInstructor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseInstructorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property CourseInstructor $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
