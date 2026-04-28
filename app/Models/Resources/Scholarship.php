<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Scholarship extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'scholarship_name',
        'description',
        'file',
        'file_description',
        'academic_year',
    ];

    public function applications()
    {
        return $this->hasMany(ScholarshipApplication::class);
    }
}
