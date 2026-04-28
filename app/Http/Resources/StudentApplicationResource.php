<?php

namespace App\Http\Resources;

use App\Models\Resources\StudentApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property StudentApplication $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
