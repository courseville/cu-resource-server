<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\HasDomainScope;

class ProgramCommittee extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasDomainScope;

    protected $fillable = [
        'program_no',
        'active_year',
        'committee_tag',
        'effective_date',
        'personal_id',
        'data_source_id',
        'data_id',
    ];
}
