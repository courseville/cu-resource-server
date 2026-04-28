<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentInternship extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'student_id',
        'process_step',
        'status',
        'grant',
        'file',
        'address_pic',
        'start_date',
        'end_date',
        'location_address',
        'location_city',
        'location_name',
        'job_description',
        'sup_name',
        'sup_position',
        'sup_phone',
        'company',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
