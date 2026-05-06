<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Scholarship extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'job_code',
        'fcode',
        'scholarship_name',
        'name_en',
        'description',
        'file',
        'file_description',
        'academic_year',
        'isactive',
        'update_by',
        'require_doc',
        'require_app1',
        'require_app2',
        'can_assign',
        'date_update',
    ];

    protected $casts = [
        'isactive' => 'boolean',
        'require_doc' => 'boolean',
        'require_app1' => 'boolean',
        'require_app2' => 'boolean',
        'can_assign' => 'boolean',
        'date_update' => 'datetime',
    ];

    public function applications()
    {
        return $this->hasMany(ScholarshipApplication::class);
    }
}
