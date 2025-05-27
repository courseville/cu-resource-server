<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StructureProfile extends Model
{
    protected $fillable = [
        'structure_level1_id',
        'structure_level2_id',
        'structure_level3_id',
        'structure_level4_id',
        'personnel_id',
    ];

    public function structureLevel1(): BelongsTo
    {
        return $this->belongsTo(Structure::class, 'structure_level1_id', 'id');
    }

    public function structureLevel2(): BelongsTo
    {
        return $this->belongsTo(Structure::class, 'structure_level2_id', 'id');
    }

    public function structureLevel3(): BelongsTo
    {
        return $this->belongsTo(Structure::class, 'structure_level3_id', 'id');
    }

    public function structureLevel4(): BelongsTo
    {
        return $this->belongsTo(Structure::class, 'structure_level4_id', 'id');
    }
}
