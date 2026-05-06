<?php

namespace App\Http\Resources;

use App\Models\Resources\ProgramCommittee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramCommitteeResource extends JsonResource
{
    /** @property ProgramCommittee $resource */
    public function toArray(Request $request): array
    {
        return [
            'program_no' => $this->program_no,
            'active_year' => $this->active_year,
            'committee_tag' => $this->committee_tag,
            'effective_date' => $this->effective_date,
            'personal_id' => $this->personal_id,
        ];
    }
}
