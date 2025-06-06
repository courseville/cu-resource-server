<?php

namespace App\Models\Resources;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personnel extends Model
{
    use Searchable;

    protected $fillable = [
        'personnel_id',
        'title_th',
        'first_name_th',
        'last_name_th',
        'title_en',
        'first_name_en',
        'last_name_en',
    ];

    protected $searchable = [
        'first_name_th',
        'last_name_th',
        'first_name_en',
        'last_name_en',
    ];

    public function structureProfiles(): HasMany
    {
        return $this->hasMany(StructureProfile::class, 'personnel_id', 'id');
    }
}
