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

        $viewableColumns = $filteredPermissions->pluck('columns')->flatten()->map(function ($column) {
            return json_decode($column, true); // Decode JSON string to array
        })->flatten()->unique()->toArray();

        return $viewableColumns;
    }
}