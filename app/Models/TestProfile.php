<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestProfile extends Model
{
    use HasFactory;

    protected $table = 'test_profiles';

    protected $fillable = [
        'test_user_id',
        'bio',
        'avatar',
        'data_source_id',
        'data_id',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(TestUser::class);
    }
}
