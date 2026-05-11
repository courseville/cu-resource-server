<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformerMapping extends Model
{
    use HasFactory;

    protected $table = 'transformer_mappings';

    protected $fillable = [
        'data_source_id',
        'model',
        'field',
        'mapping',
        'formatting',
    ];
}
