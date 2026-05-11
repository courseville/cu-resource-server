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
        $meta = $this->sync_meta ?? ['fields' => []];
        if (is_string($meta)) {
            $meta = json_decode($meta, true);
        }

        if (! isset($meta['fields'])) {
            $meta['fields'] = [];
        }

        $sourceId = \App\Sync\SyncContext::getSourceId();
        $userId = Auth::id();
        $now = now()->toDateTimeString();

        $dirty = $this->getDirty();
        $attributes = $this->getAttributes();

        // Fields to ignore from sync meta tracking
        $ignore = ['id', 'sync_meta', 'updated_at', 'created_at', 'deleted_at'];

        // 1. Update dirty fields with current sync context
        foreach ($dirty as $field => $value) {
            if (in_array($field, $ignore)) {
                continue;
            }

            $meta['fields'][$field] = [
                'source_id' => $sourceId,
                'user_id' => $sourceId ? null : $userId,
                'at' => $now,
            ];
        }

        // 2. Ensure all other attributes have a default sync meta if missing
        foreach ($attributes as $field => $value) {
            if (in_array($field, $ignore)) {
                continue;
            }

            if (! isset($meta['fields'][$field])) {
                if ($sourceId) {
                    // During sync, attribute untracked fields to the current source
                    $meta['fields'][$field] = [
                        'source_id' => $sourceId,
                        'user_id' => null,
                        'at' => $now,
                    ];
                } else {
                    // Manual update, use null defaults for untracked fields
                    $meta['fields'][$field] = [
                        'source_id' => null,
                        'user_id' => null,
                        'at' => null,
                    ];
                }
            }
        }

        $this->sync_meta = $meta;
    }
}
