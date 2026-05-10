<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}

/*
|--------------------------------------------------------------------------
| RBAC test helpers
|--------------------------------------------------------------------------
|
| Helpers for building Passport OAuth clients with Roles + Permissions for
| API endpoint tests. Use `actingAsApiClient()` to authenticate the request
| as a Passport client carrying the supplied column-level permissions.
|
*/

use App\Models\Client;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

function makeOauthClient(string $name = 'Test Client'): Client
{
    return Client::create([
        'id' => (string) Str::uuid(),
        'name' => $name,
        'secret' => bcrypt(Str::random(40)),
        'redirect' => 'http://localhost',
        'personal_access_client' => false,
        'password_client' => false,
        'revoked' => false,
        'user_id' => null,
    ]);
}

function makePermission(string $modelClass, array $columns, string $action = 'view'): Permission
{
    return Permission::create([
        'name' => $action.'_'.class_basename($modelClass).'_'.Str::random(6),
        'action' => $action,
        'model' => $modelClass,
        'columns' => $columns,
    ]);
}

function attachPermissionsToClient(Client $client, array $permissions, string $domain = 'TEST'): Client
{
    $role = Role::create([
        'name' => 'role_'.Str::random(8),
        'description' => 'Test role',
    ]);
    foreach ($permissions as $permission) {
        $role->permissions()->attach($permission->id);
    }
    $client->roles()->attach($role->id, ['domain' => $domain]);

    return $client;
}

/**
 * Authenticate the test request as the given Passport client with the given scopes.
 */
function actingAsApiClient(Client $client, array $scopes = ['*']): void
{
    Passport::actingAsClient($client, $scopes);
}
