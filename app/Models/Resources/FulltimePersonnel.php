<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FulltimePersonnel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'full_time_personnel';

    protected $fillable = [
        'sync_meta',
        'personnel_id',
        'full_time_id',
        'university',
        'degree',
        'education_level',
        'date_of_appointment',
        'asst_prof_date',
        'prof_date',
        'assoc_prof_date',
        'birth_date',
        'age',
        'personnel_status_changing_date',
        'salary_band',
        'teacher_date',
        'job_type',
    ];

    protected $casts = [
        'sync_meta' => 'json',
        'date_of_appointment' => 'datetime',
        'asst_prof_date' => 'datetime',
        'prof_date' => 'datetime',
        'assoc_prof_date' => 'datetime',
        'birth_date' => 'datetime',
        'personnel_status_changing_date' => 'datetime',
        'teacher_date' => 'datetime',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
