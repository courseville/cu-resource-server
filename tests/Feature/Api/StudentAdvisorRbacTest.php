<?php

use App\Models\Resources\StudentAdvisor;

beforeEach(function () {
    StudentAdvisor::create([
        'student_id' => 'S001',
        'staff_id' => 'ST001',
    ]);
});

it('returns 401 when no client credentials are presented', function () {
    $response = $this->getJson('/api/v1/student-advisors');

    $response->assertStatus(401);
});

it('returns 403 when the client has no view permission for StudentAdvisor', function () {
    $client = makeOauthClient();
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/student-advisors');

    $response->assertStatus(403);
});

it('returns paginated rows with only the columns the client is permitted to see', function () {
    $client = makeOauthClient();
    $permission = makePermission(StudentAdvisor::class, ['student_id', 'staff_id']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/student-advisors');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                ['student_id', 'staff_id'],
            ],
        ]);

    $row = $response->json('data.0');
    expect($row['student_id'])->not->toBeNull()
        ->and($row['staff_id'])->not->toBeNull();
});

it('returns a single row if the client has permission', function () {
    $advisor = StudentAdvisor::first();
    $client = makeOauthClient();
    $permission = makePermission(StudentAdvisor::class, ['student_id', 'staff_id']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson("/api/v1/student-advisors/{$advisor->id}");

    $response->assertOk()
        ->assertJsonStructure([
            'data' => ['student_id', 'staff_id'],
        ]);
});
