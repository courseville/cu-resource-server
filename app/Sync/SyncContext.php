<?php

namespace App\Sync;

class SyncContext
{
    protected static $sourceId = null;

    public static function setSourceId(?int $sourceId): void
    {
        static::$sourceId = $sourceId;
    }

    public static function getSourceId(): ?int
    {
        return static::$sourceId;
    }
}
