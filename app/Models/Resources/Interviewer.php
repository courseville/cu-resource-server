<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Interviewer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}
