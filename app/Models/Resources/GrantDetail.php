<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class GrantDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'grant_detail';

    protected $fillable = [
        'sync_meta',
        'student_id',
        'type',
        'travel_cost',
        'accommodation_cost',
        'lump_sum_allowance',
        'first_student_id',
        'second_student_id',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
