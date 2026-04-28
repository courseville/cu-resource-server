<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentApplication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'application_id',
        'citizen_id',
        'transcript_title',
        'first_name',
        'last_name',
        'student_type',
    ];
}
