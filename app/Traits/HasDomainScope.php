<?php

namespace App\Traits;

use App\Models\Scopes\DataDomainScope;

trait HasDomainScope
{
    /**
     * Boot the trait and apply the global scope.
     */
    public static function bootHasDomainScope(): void
    {
        static::addGlobalScope(new DataDomainScope);
    }

    /**
     * Get the column name used for domain scoping.
     * Override this in the model if the column is not 'faccode'.
     */
    public function getDomainColumn(): string
    {
        return 'faccode';
    }
}
