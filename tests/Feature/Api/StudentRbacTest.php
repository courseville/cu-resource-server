<?php

use App\Models\Resources\Student;

beforeEach(function () {
    Student::create([
        'student_id' => 'S001',
        'first_name_th' => 'Somchai',
        'last_name_th' => 'Jaidee',
        'first_name_en' => 'Somchai',
        'last_name_en' => 'Jaidee',
        'faccode' => 'TEST',
    ]);
    Student::create([
        'student_id' => 'S002',
        'first_name_th' => 'Suda',
        'last_name_th' => 'Sukjai',
        'first_name_en' => 'Suda',
        'last_name_en' => 'Sukjai',
        'faccode' => 'TEST',
    ]);
});

it('returns 401 when no client credentials are presented', function () {
    $response = $this->getJson('/api/v1/students');

    $response->assertStatus(401);
});

it('returns 403 when the client has no view permission for Student', function () {
    $client = makeOauthClient();
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students');

    $response->assertStatus(403);
});

it('returns 403 when the client has a permission for a different model', function () {
    $client = makeOauthClient();
    $permission = makePermission(\App\Models\User::class, ['id', 'name', 'email']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students');

    $response->assertStatus(403);
});

it('returns 403 when the client has only non-view actions on Student', function () {
    $client = makeOauthClient();
    $permission = makePermission(Student::class, ['student_id'], 'edit');
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students');

    $response->assertStatus(403);
});

it('returns paginated rows with only the columns the client is permitted to see', function () {
    $client = makeOauthClient();
    $permission = makePermission(Student::class, ['student_id', 'first_name_th']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                ['student_id', 'first_name_th'],
            ],
            'links',
            'meta',
        ]);

    $row = $response->json('data.0');
    expect($row['student_id'])->not->toBeNull()
        ->and($row['first_name_th'])->not->toBeNull()
        ->and($row['last_name_th'])->toBeNull()
        ->and($row['faccode'])->toBeNull();
});

it('merges columns from multiple permissions on the same model+action', function () {
    $client = makeOauthClient();
    $p1 = makePermission(Student::class, ['student_id']);
    $p2 = makePermission(Student::class, ['first_name_th', 'last_name_th']);
    attachPermissionsToClient($client, [$p1, $p2]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students');

    $response->assertOk();
    $row = $response->json('data.0');
    expect($row['student_id'])->not->toBeNull()
        ->and($row['first_name_th'])->not->toBeNull()
        ->and($row['last_name_th'])->not->toBeNull()
        ->and($row['faccode'])->toBeNull();
});

it('respects the n query parameter for page size', function () {
    Student::create(['student_id' => 'S003', 'first_name_th' => 'A', 'last_name_th' => 'B', 'faccode' => 'TEST']);

    $client = makeOauthClient();
    $permission = makePermission(Student::class, ['student_id']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students?n=1');

    $response->assertOk()
        ->assertJsonCount(1, 'data');
});
