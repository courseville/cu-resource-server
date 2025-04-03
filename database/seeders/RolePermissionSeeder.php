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

        // Preset permissions
        $permissions = [
            'view_courses', 'edit_courses', 'delete_courses', 'enroll_students',
            'view_users', 'edit_users', 'delete_users',
            'view_reports', 'generate_reports',
        ];

        // Insert permissions
        DB::table('permissions')->insert(array_map(fn($perm) => [
            'name' => $perm,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], $permissions));

        // Map roles to permissions
        $rolePermissions = [
            'admin' => ['view_courses', 'edit_courses', 'delete_courses', 'view_users', 'edit_users', 'delete_users', 'view_reports', 'generate_reports'],
            'faculty' => ['view_courses', 'edit_courses', 'enroll_students'],
            'student' => ['view_courses'],
            'client_readonly' => ['view_courses', 'view_users'],
            'client_full_access' => ['view_courses', 'view_users', 'generate_reports'],
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

        // Assign roles to example users and clients
        DB::table('user_roles')->insert([
            ['user_id' => 1, 'role_id' => DB::table('roles')->where('name', 'admin')->value('id')],
            ['user_id' => 2, 'role_id' => DB::table('roles')->where('name', 'faculty')->value('id')],
            ['user_id' => 3, 'role_id' => DB::table('roles')->where('name', 'student')->value('id')],
        ]);

        DB::table('oauth_client_roles')->insert([
            ['oauth_client_id' => 1, 'role_id' => DB::table('roles')->where('name', 'client_readonly')->value('id')],
            ['oauth_client_id' => 2, 'role_id' => DB::table('roles')->where('name', 'client_full_access')->value('id')],
        ]);
    }
}
