<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class DataDomainScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // 1. Get the authenticated user or client
        $entity = Auth::user();

        // If no authenticated user, try to get the client from the request (for client_credentials grant)
        if (!$entity && request()->user('api')) {
            $entity = request()->user('api');
        }

        // If still no entity (e.g., guest), or if it's a super admin, don't apply scoping
        // Assuming 'admin' role has no domain restriction or exists to see everything
        $isSuperAdmin = $entity ? $this->isSuperAdmin($entity) : false;
        logger()->info('isSuperAdmin check', ['result' => $isSuperAdmin]);
        
        if (!$entity || $isSuperAdmin) {
            return;
        }

        // 2. Retrieve domains associated with the entity's roles
        $domains = $this->getEntityDomains($entity);

        // If no domains are assigned, we assume they can see nothing (safe default)
        // or everything if that's the policy. Usually, no domain means no access to scoped data.
        if (empty($domains)) {
            $builder->whereRaw('1 = 0');
            return;
        }

        // 3. Apply the filter based on the model's domain column
        $column = method_exists($model, 'getDomainColumn') ? $model->getDomainColumn() : 'faccode';
        
        $builder->whereIn($column, $domains);
    }

    /**
     * Check if the entity is a super admin.
     */
    protected function isSuperAdmin($entity): bool
    {
        // Check if user has 'admin' role with no domain restriction
        // This is a placeholder logic; adjust based on actual role names
        return $entity->roles()->where('name', 'admin')->exists() && 
               !$entity->roles()->where('name', 'admin')->wherePivotNotNull('domain')->exists();
    }

    /**
     * Fetch all domains assigned to the user/client via their roles.
     */
    protected function getEntityDomains($entity): array
    {
        return $entity->roles->pluck('pivot.domain')->filter()->unique()->toArray();
    }
}
