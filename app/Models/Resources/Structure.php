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
        'structure_id',
        'name',
    ];

    protected $searchable = [
        'name',
    ];
}
