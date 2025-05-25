<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'action', 'model', 'columns'];

    protected $casts = [
        'columns' => 'array', // Automatically cast 'columns' to an array
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    // Dynamically resolve the related model based on the 'model' field
    public function modelInstance()
    {
        return app($this->model);
    }
}
