<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PkModel extends Model
{
    use HasFactory;

    protected $table = 'pk_model_fields';

    protected $fillable = [
        'model',
        'primary_key',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
