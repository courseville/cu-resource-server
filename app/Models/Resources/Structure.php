<?php

namespace App\Models\Resources;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Structure extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Searchable;

    protected $fillable = [
        'sync_meta',
        'structure_id',
        'name',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    protected $searchable = [
        'name',
    ];
}
