<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Preset roles
        $roles = [
            ['name' => 'admin', 'entity_type' => 'user'],
            ['name' => 'faculty', 'entity_type' => 'user'],
            ['name' => 'student', 'entity_type' => 'user'],
            ['name' => 'client_readonly', 'entity_type' => 'client'],
            ['name' => 'client_full_access', 'entity_type' => 'client'],
        ];

        // Insert roles
        DB::table('roles')->insert(array_map(fn($role) => [
            'name' => $role['name'],
            'entity_type' => $role['entity_type'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], $roles));

        // Preset permissions for User-related actions
        $permissions = [
            ['name' => 'view_users', 'action' => 'view', 'model' => 'App\Models\User', 'columns' => json_encode(['id', 'name', 'email'])],
            ['name' => 'view_user_name', 'action' => 'view', 'model' => 'App\Models\User', 'columns' => json_encode(['name'])],
            ['name' => 'edit_users', 'action' => 'edit', 'model' => 'App\Models\User', 'columns' => json_encode(['name', 'email'])],
            ['name' => 'delete_users', 'action' => 'delete', 'model' => 'App\Models\User', 'columns' => json_encode(['id'])],
            ['name' => 'view_courses', 'action' => 'view', 'model' => 'App\Models\Course', 'columns' => json_encode(['id', 'name'])],
            ['name' => 'edit_courses', 'action' => 'edit', 'model' => 'App\Models\Course', 'columns' => json_encode(['name'])],
        ];

        // Insert permissions
        foreach ($permissions as $perm) {
            DB::table('permissions')->insert([
                'name' => $perm['name'],
                'action' => $perm['action'],
                'model' => $perm['model'],
                'columns' => json_encode($perm['columns']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Map roles to permissions
        $rolePermissions = [
            'admin' => ['view_users', 'edit_users', 'delete_users','view_courses', 'edit_courses'],
            'faculty' => ['view_users','view_courses', 'edit_courses'],
            'student' => ['view_courses','view_user_name'],
            'client_readonly' => ['view_courses'],
            'client_full_access' => ['view_courses', 'view_users'],
        ];

        // Assign permissions to roles
        foreach ($rolePermissions as $role => $perms) {
            $roleId = DB::table('roles')->where('name', $role)->value('id');

            foreach ($perms as $perm) {
                $permId = DB::table('permissions')->where('name', $perm)->value('id');
                DB::table('role_permissions')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // Assign roles to example users
        DB::table('user_roles')->insert([
            ['user_id' => 2, 'role_id' => DB::table('roles')->where('name', 'admin')->value('id')],
            ['user_id' => 3, 'role_id' => DB::table('roles')->where('name', 'faculty')->value('id')],
            ['user_id' => 4, 'role_id' => DB::table('roles')->where('name', 'student')->value('id')],
        ]);

        // Optionally, assign roles to the OAuth clients (if needed)
        DB::table('oauth_client_roles')->insert([
            ['oauth_client_id' => 2, 'role_id' => DB::table('roles')->where('name', 'client_full_access')->value('id')],
        ]);
    }
}
