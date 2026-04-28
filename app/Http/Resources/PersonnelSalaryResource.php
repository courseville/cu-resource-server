<?php

namespace App\Http\Resources;

use App\Models\Resources\PersonnelSalary;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelSalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property PersonnelSalary $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
