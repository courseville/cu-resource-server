<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use App\Traits\HasSyncMeta;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProgramCommittee extends Model implements Auditable
{
    use HasDomainScope, HasSyncMeta, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'program_no',
        'active_year',
        'committee_tag',
        'effective_date',
        'personal_id',
        'data_source_id',
        'sync_meta',
        'data_id',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];
}
