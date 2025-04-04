<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformerMapping extends Model
{
    use HasFactory;

    protected $table = 'transformer_mappings';

    protected $fillable = [
        'source',
        'model',
        'field',
        'mapping',
        'formatting',
    ];
}
