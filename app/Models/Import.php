<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'completed_at',
        'file_name',
        'file_path',
        'importer',
        'processed_rows',
        'total_rows',
        'successful_rows',
        'user_id',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function failedRows()
    {
        return $this->hasMany(FailedDataImportRow::class, 'import_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
