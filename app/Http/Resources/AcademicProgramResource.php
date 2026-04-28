<?php

namespace App\Http\Resources;

use App\Models\Resources\AcademicProgram;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademicProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property AcademicProgram $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
