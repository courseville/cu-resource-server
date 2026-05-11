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

/*
|--------------------------------------------------------------------------
| Filament panel test helpers
|--------------------------------------------------------------------------
|
| `actAsAdminPanelUser()` boots a user that is treated as super-admin by
| DataDomainScope so panel tests can see all records, and bypasses
| User::canAccessPanel() by switching the env to 'local'.
|
*/

use App\Models\DataSource;
use App\Models\Resources\Personnel;
use App\Models\Resources\Scholarship;
use App\Models\Resources\ScholarshipApplication;
use App\Models\Resources\Student;
use App\Models\Resources\StudentInternship;
use App\Models\TransformerMapping;
use App\Models\User;

function actAsAdminPanelUser(): User
{
    // canAccessPanel() short-circuits when env is local.
    config(['app.env' => 'local']);

    $user = User::factory()->create();

    // DataDomainScope treats a user as super-admin when they have a role
    // named 'admin' with no domain set in the pivot. This unblocks queries
    // against models that use HasDomainScope (Student, Personnel).
    $role = Role::firstOrCreate(['name' => 'admin'], ['description' => 'Super admin']);
    $user->roles()->attach($role->id, ['domain' => null]);

    test()->actingAs($user, 'admin');

    return $user;
}

function makeStudent(array $overrides = []): Student
{
    // forceFill so non-fillable columns (e.g. citizen_id) used by the form
    // are still persisted when the helper builds a record for Edit/View tests.
    $student = new Student;
    $student->forceFill(array_merge([
        'student_id' => 'S'.Str::random(8),
        'first_name_th' => 'สมชาย',
        'last_name_th' => 'ใจดี',
        'first_name_en' => 'Somchai',
        'last_name_en' => 'Jaidee',
        'citizen_id' => '1'.fake()->numerify('############'),
    ], $overrides));
    $student->save();

    return $student;
}

function makePersonnel(array $overrides = []): Personnel
{
    return Personnel::create(array_merge([
        'personnel_id' => 'P'.Str::random(8),
        'first_name_th' => 'อาจารย์',
        'last_name_th' => 'ทดสอบ',
        'first_name_en' => 'Test',
        'last_name_en' => 'Instructor',
    ], $overrides));
}

function makeScholarship(array $overrides = []): Scholarship
{
    return Scholarship::create(array_merge([
        'job_code' => 'JOB-'.Str::random(6),
        'scholarship_name' => 'ทุนทดสอบ',
        'name_en' => 'Test Scholarship',
        'academic_year' => 2026,
        'isactive' => true,
    ], $overrides));
}

function makeScholarshipApplication(array $overrides = []): ScholarshipApplication
{
    $student = $overrides['student'] ?? makeStudent();
    $scholarship = $overrides['scholarship'] ?? makeScholarship();
    unset($overrides['student'], $overrides['scholarship']);

    return ScholarshipApplication::create(array_merge([
        'student_id' => $student->student_id,
        'job_code' => $scholarship->job_code,
        'status' => 'pending',
        'confirm' => false,
    ], $overrides));
}

function makeStudentInternship(array $overrides = []): StudentInternship
{
    $student = $overrides['student'] ?? makeStudent();
    unset($overrides['student']);

    return StudentInternship::create(array_merge([
        'student_id' => $student->student_id,
        'intern_year' => 2026,
        'status' => 'pending',
        'company' => 'Acme Co',
    ], $overrides));
}

function makeDataSource(array $overrides = []): DataSource
{
    return DataSource::create(array_merge([
        'name' => 'Source '.Str::random(6),
        'type' => 'file',
        'url' => '/tmp/source-'.Str::random(6).'.csv',
        'is_active' => true,
    ], $overrides));
}

function makeTransformerMapping(array $overrides = []): TransformerMapping
{
    $dataSource = $overrides['data_source'] ?? makeDataSource();
    unset($overrides['data_source']);

    // data_source_id is not in the model's $fillable, so forceFill it.
    $mapping = new TransformerMapping;
    $mapping->forceFill(array_merge([
        'data_source_id' => $dataSource->id,
        'model' => 'App\\Models\\Resources\\Student',
        'field' => 'first_name_th',
        'mapping' => 'fname_th',
    ], $overrides));
    $mapping->save();

    return $mapping;
}
