<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestNisit extends Model
{
    use HasFactory;
    protected $table = 'test_nisits';
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'password',
        'bio',
        'avatar',
        'phone_number'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
