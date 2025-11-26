<?php

namespace App\Models\Resources;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Personnel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Searchable;

    protected $fillable = [
        'personnel_id',
        'title_th',
        'first_name_th',
        'last_name_th',
        'title_en',
        'first_name_en',
        'last_name_en',
        'public_email',
        'private_email',
        'phone_no',
        'telephone_no',
        'website',
        'building',
        'floor',
        'room',
        'registered_address',
        'registered_sub_district',
        'registered_district',
        'registered_province',
        'registered_postal_code',
        'current_address',
        'current_sub_district',
        'current_district',
        'current_province',
        'current_postal_code',
        'passport_no',
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

    public function fulltime(): HasMany
    {
        return $this->hasMany(FulltimePersonnel::class, 'personnel_id', 'id');
    }
}
