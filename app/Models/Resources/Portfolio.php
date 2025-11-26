<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Portfolio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'application_id',
        'signature',
        'email',
        'phone_number',
        'picture',
        'intro_video',
        'work',
    ];

    public function application()
    {
        return $this->belongsTo(StudentApplication::class);
    }
}
