<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    use HasFactory;

    protected $table = 'data_sources';

    protected $fillable = [
        'name',
        'url',
    ];

    public function transformerMappings()
    {
        return $this->hasMany(TransformerMapping::class, 'data_source_id');
    }
}
