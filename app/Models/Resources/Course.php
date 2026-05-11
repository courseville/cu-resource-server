<?php

namespace App\Models\Resources;

use App\Traits\HasDomainScope;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSyncMeta;
use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    use HasDomainScope, HasSyncMeta, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'description',
        'code',
        'credits',
        'course_id',
        'program_id',
        'type_code',
        'program_group_id',
        'course_no',
        'revision_year',
        'name_th',
        'name_en',
        'name_abbr',
        'l_credit',
        'nl_credit',
        'l_hour',
        'nl_hour',
        's_hour',
        'description_th',
        'description_en',
        'faccode',
        'data_source_id',
        'sync_meta',
        'data_id',
    ];

    protected $casts = [
        'sync_meta' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->name)) {
                $model->name = $model->name_en ?: $model->name_th ?: $model->code ?: 'Unknown Course';
            }
        });
    }
}
