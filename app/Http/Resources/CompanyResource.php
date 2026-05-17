<?php

namespace App\Http\Resources;

use App\Models\Resources\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /** @property Company $resource */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'admin_name' => $this->admin_name,
            'admin_title' => $this->admin_title,
            'tel' => $this->tel,
        ];
    }
}
