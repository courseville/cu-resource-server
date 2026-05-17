<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataConflict extends Model
{
    protected $fillable = [
        'model_class',
        'model_pk_value',
        'data_source_id',
        'incoming_data',
        'current_data',
        'status',
        'resolved_by',
        'resolved_at',
    ];

    protected $casts = [
        'incoming_data' => 'array',
        'current_data' => 'array',
        'resolved_at' => 'datetime',
    ];

    public function dataSource(): BelongsTo
    {
        return $this->belongsTo(DataSource::class);
    }

    public function resolvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
}
