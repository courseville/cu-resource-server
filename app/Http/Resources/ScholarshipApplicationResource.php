<?php

namespace App\Http\Resources;

use App\Models\Resources\ScholarshipApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScholarshipApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property ScholarshipApplication $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
