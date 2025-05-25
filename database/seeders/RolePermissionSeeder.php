<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Preset roles
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator with full access to the system'],
            ['name' => 'faculty', 'description' => 'Faculty member with access to course management'],
            ['name' => 'student', 'description' => 'Student with access to view courses and limited user data'],
            ['name' => 'client_readonly', 'description' => 'Client with read-only access to resources'],
            ['name' => 'client_full_access', 'description' => 'Client with full access to resources'],
        ];

        // Insert roles
        DB::table('roles')->insert(array_map(fn ($role) => [
            'name' => $role['name'],
            'description' => $role['description'],
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
            'admin' => ['view_users', 'edit_users', 'delete_users', 'view_courses', 'edit_courses'],
            'faculty' => ['view_users', 'view_courses', 'edit_courses'],
            'student' => ['view_courses', 'view_user_name'],
            'client_readonly' => ['view_courses'],
            'client_full_access' => ['view_courses', 'view_users'],
        ];

        // Assign permissions to roles
        foreach ($rolePermissions as $role => $perms) {
            $roleId = DB::table('roles')->where('name', $role)->value('id');

            foreach ($perms as $perm) {
                $permId = DB::table('permissions')->where('name', $perm)->value('id');
                DB::table('permission_role')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // Assign roles to example users
        DB::table('role_user')->insert([
            ['user_id' => DB::table('users')->where('name', '2')->value('id'), 'role_id' => DB::table('roles')->where('name', 'admin')->value('id')],
            ['user_id' => DB::table('users')->where('name', '3')->value('id'), 'role_id' => DB::table('roles')->where('name', 'faculty')->value('id')],
            ['user_id' => DB::table('users')->where('name', '4')->value('id'), 'role_id' => DB::table('roles')->where('name', 'student')->value('id')],
        ]);

        // Optionally, assign roles to the OAuth clients (if needed)
        DB::table('oauth_client_role')->insert([
            ['oauth_client_id' => DB::table('oauth_clients')->where('name', 'Client with User Data')->value('id'), 'role_id' => DB::table('roles')->where('name', 'client_full_access')->value('id')],
        ]);
    }
}
