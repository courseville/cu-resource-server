<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PersonnelSalary extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'personnel_salary';

    protected $fillable = [
        'personnel_id',
        'amount',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
