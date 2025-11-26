<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class RetiredPersonnel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'retired_personnel';

    protected $fillable = [
        'personnel_id',
        'retired_id',
        'date',
        'type',
        'citizen_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
