<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasSyncMeta
{
    /**
     * Boot the trait.
     */
    protected static function bootHasSyncMeta()
    {
        static::saving(function ($model) {
            $model->updateSyncMeta();
        });
    }

    /**
     * Update the sync_meta attribute based on dirty fields.
     */
    public function updateSyncMeta(): void
    {
        $dirty = $this->getDirty();
        
        // Remove internal fields from tracking
        unset($dirty['sync_meta']);
        unset($dirty['updated_at']);
        unset($dirty['created_at']);

        if (empty($dirty)) {
            return;
        }

        $meta = $this->sync_meta ?? ['fields' => []];
        if (is_string($meta)) {
            $meta = json_decode($meta, true);
        }
        
        if (!isset($meta['fields'])) {
            $meta['fields'] = [];
        }

        $sourceId = \App\Sync\SyncContext::getSourceId();
        $userId = Auth::id();
        $now = now()->toDateTimeString();

        foreach ($dirty as $field => $value) {
            $meta['fields'][$field] = [
                'source_id' => $sourceId,
                'user_id' => $sourceId ? null : $userId,
                'at' => $now,
            ];
        }

        $this->sync_meta = $meta;
    }
}
