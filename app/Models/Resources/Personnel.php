<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use App\Traits\HasSyncMeta;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Personnel extends Model implements Auditable
{
    use HasDomainScope, HasSyncMeta, \OwenIt\Auditing\Auditable;
    use Searchable;

    protected $fillable = [
        'sync_meta',
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
        'rank_title',
        'doctoral_title',
        'acad_title_1',
        'acad_title_2',
        'title_by_the_king',
        'full_title',
        'faccode',
        'depcode',
        // 'academic_position',
        'citizen_id',
        'birth_date',
        'marital_status',
        'department',
        'personnel_status',
        'personnel_type',
        'status_change_date',
        'personnel_group',
        'personnel_subgroup',
        'position_name',
        'position_number',
        'position_appointment_date',
        'start_date',
        'transformation_date',
        'structure_level1_name',
        'structure_level2_name',
        'structure_level3_name',
        'structure_level4_name',
    ];

    protected $casts = [
        'sync_meta' => 'json',
        'birth_date' => 'date',
        'status_change_date' => 'date',
        'position_appointment_date' => 'date',
        'start_date' => 'date',
        'transformation_date' => 'date',
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

    public function educations(): HasMany
    {
        return $this->hasMany(PersonnelEducation::class, 'personnel_id', 'personnel_id');
    }

    public function positions(): HasMany
    {
        return $this->hasMany(PersonnelPosition::class, 'personnel_id', 'personnel_id');
    }

    public function studentAdvisors(): HasMany
    {
        return $this->hasMany(StudentAdvisor::class, 'staff_id', 'personnel_id');
    }
}
