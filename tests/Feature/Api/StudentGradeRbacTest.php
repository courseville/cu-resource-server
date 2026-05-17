<?php

use App\Models\Resources\StudentGrade;

beforeEach(function () {
    StudentGrade::create([
        'student_code' => '6431311921',
        'year' => '2024',
        'semester' => '1',
        'course_code' => '2110101',
        'total_credit' => '3',
        'grade' => 'A',
        'faccode' => '21',
    ]);
});

it('returns 401 when no client credentials are presented', function () {
    $response = $this->getJson('/api/v1/student-grades');

    $response->assertStatus(401);
});

it('returns 403 when the client has no view permission for StudentGrade', function () {
    $client = makeOauthClient();
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/student-grades');

    $response->assertStatus(403);
});

it('returns paginated rows with only the columns the client is permitted to see', function () {
    $client = makeOauthClient();
    $permission = makePermission(StudentGrade::class, ['student_code', 'grade']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/student-grades');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                ['student_code', 'grade'],
            ],
        ]);

    $row = $response->json('data.0');
    expect($row['student_code'])->not->toBeNull()
        ->and($row['grade'])->not->toBeNull()
        ->and($row['course_code'])->toBeNull();
});

it('returns a single row if the client has permission', function () {
    $grade = StudentGrade::first();
    $client = makeOauthClient();
    $permission = makePermission(StudentGrade::class, ['student_code', 'grade']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson("/api/v1/student-grades/{$grade->id}");

    $response->assertOk()
        ->assertJsonStructure([
            'data' => ['student_code', 'grade'],
        ]);
});
