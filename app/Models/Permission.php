<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected $fillable = ['name','action', 'model', 'columns'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions'); 
    }

    // Convert the columns field to an array when it's retrieved from the database
    public function getColumnsAttribute($value)
    {
        return json_decode($value, true); // Decode JSON into array
    }

    // Convert the array of columns into JSON when setting the attribute
    public function setColumnsAttribute($value)
    {
        $this->attributes['columns'] = json_encode($value); // Encode array as JSON
    }

    // Dynamically resolve the related model based on the 'model' field
    public function modelInstance()
    {
        return app($this->model);
    }
}
