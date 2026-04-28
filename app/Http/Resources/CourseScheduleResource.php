<?php

namespace App\Http\Resources;

use App\Models\Resources\CourseSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property CourseSchedule $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
