<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Company extends Model implements Auditable
{
    use \App\Traits\HasSyncMeta;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'address',
        'admin_name',
        'admin_title',
        'tel',
        'sync_meta',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    public function internships(): HasMany
    {
        return $this->hasMany(StudentInternship::class);
    }
}
