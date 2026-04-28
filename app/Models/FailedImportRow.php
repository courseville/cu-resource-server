<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedImportRow extends Model
{
    protected $table = 'failed_import_rows';

    protected $fillable = [
        'data',
        'import_id',
        'validation_error',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function import()
    {
        return $this->belongsTo(Import::class, 'import_id');
    }
}
