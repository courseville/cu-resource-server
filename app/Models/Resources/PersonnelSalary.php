<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelSalary extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'personnel_salary';

    protected $fillable = [
        'sync_meta',
        'personnel_id',
        'amount',
        'date',
    ];

    protected $casts = [
        'sync_meta' => 'json',
        'date' => 'datetime',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
