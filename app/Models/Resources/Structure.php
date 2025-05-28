<?php

namespace App\Models\Resources;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use Searchable;

    protected $fillable = [
        'structure_id',
        'name',
    ];

    protected $searchable = [
        'name',
    ];
}
