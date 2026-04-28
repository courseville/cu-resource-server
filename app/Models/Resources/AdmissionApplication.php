<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AdmissionApplication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'admission_application';

    protected $fillable = [
        'application_id',
        'school',
        'score',
    ];

    public function application()
    {
        return $this->belongsTo(StudentApplication::class);
    }
}
