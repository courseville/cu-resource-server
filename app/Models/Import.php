<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'data_source_id',
        'completed_at',
        'file_name',
        'file_path',
        'importer',
        'processed_rows',
        'total_rows',
        'successful_rows',
        'user_id',
    ];

    public function dataSource()
    {
        return $this->belongsTo(DataSource::class);
    }

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function failedRows()
    {
        return $this->hasMany(FailedImportRow::class, 'import_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
