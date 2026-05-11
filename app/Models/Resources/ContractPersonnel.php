<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ContractPersonnel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'contract_personnel';

    protected $fillable = [
        'sync_meta',
        'personnel_id',
        'contract_id',
        'start_date',
        'end_date',
        'detail',
    ];

    protected $casts = [
        'sync_meta' => 'json',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
