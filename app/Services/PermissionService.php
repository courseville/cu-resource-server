<?php

namespace App\Services;

class PermissionService
{
    public function allowedColumns($entity, string $action, string $model): array
    {
        // Entity can be either a User or a Client
        $roles = $entity->roles;
        $permissions = $roles->flatMap(function ($role) {
            return $role->permissions;
        });

        $filteredPermissions = $permissions->filter(function ($permission) use ($model, $action) {
            $modelInstance = $permission->modelInstance();

            return $modelInstance instanceof $model && $permission->action === $action;
        });

        if ($filteredPermissions->isEmpty()) {
            return []; // No access to this model with the specified action
        }

        // Permission's `columns` attribute is cast to array by the Permission model,
        // so flatten the collection of column lists into a unique flat list.
        return $filteredPermissions->pluck('columns')->flatten()->filter()->unique()->values()->toArray();
    }
}
