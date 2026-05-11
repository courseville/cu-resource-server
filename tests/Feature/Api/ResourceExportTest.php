<?php

use App\Models\Resources\Personnel;
use App\Models\Resources\Structure;
use App\Models\Resources\Student;
use Illuminate\Support\Carbon;

beforeEach(function () {
    Carbon::setTestNow('2026-05-11 11:13:29');

    // Seed some data
    makeStudent(['student_id' => 'S001', 'first_name_th' => 'John', 'last_name_th' => 'Doe']);
    makeStudent(['student_id' => 'S002', 'first_name_th' => 'Jane', 'last_name_th' => 'Smith']);

    $s1 = Structure::create(['structure_id' => 'STR1', 'name' => 'Dept A']);
    makePersonnel(['personnel_id' => 'P001', 'first_name_th' => 'Alice']);
    $p2 = makePersonnel(['personnel_id' => 'P002', 'first_name_th' => 'Bob']);

    // Add structure profile for Bob
    $p2->structureProfiles()->create([
        'structure_level1_id' => $s1->id,
        'position_th' => 'Lecturer',
    ]);
});

it('denies export to unauthorized users', function () {
    $response = $this->getJson('/api/v1/students/export');
    $response->assertStatus(401);
});

it('denies export to clients without view permission', function () {
    $client = makeOauthClient();
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students/export');
    $response->assertStatus(403);
});

it('exports students to CSV for authorized clients', function () {
    $client = makeOauthClient();
    $permission = makePermission(Student::class, ['student_id', 'first_name_th']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students/export?format=csv');

    $response->assertOk();
    $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    $response->assertHeader('Content-Disposition', 'attachment; filename="student_20260511_111329.csv"');

    $content = $response->streamedContent();
    $lines = explode("\n", trim($content));

    // Header
    expect($lines[0])->toBe('student_id,first_name_th');

    // Data (order might vary, but we have 2 students)
    expect(count($lines))->toBe(3); // 1 header + 2 rows
});

it('exports students to XLSX for authorized clients', function () {
    $client = makeOauthClient();
    $permission = makePermission(Student::class, ['student_id', 'first_name_th']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/students/export?format=xlsx');

    $response->assertOk();
    $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $response->assertHeader('Content-Disposition', 'attachment; filename=student_20260511_111329.xlsx');
});

it('filters student export by search query', function () {
    $client = makeOauthClient();
    $permission = makePermission(Student::class, ['student_id', 'first_name_th']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    // Search for "Jane"
    $response = $this->getJson('/api/v1/students/export?format=csv&name=Jane');

    $response->assertOk();
    $content = $response->streamedContent();
    $lines = explode("\n", trim($content));

    expect(count($lines))->toBe(2); // 1 header + 1 row (Jane)
    expect($lines[1])->toContain('Jane');
    expect($lines[1])->not->toContain('John');
});

it('filters personnel export by structure_id', function () {
    $client = makeOauthClient();
    $permission = makePermission(Personnel::class, ['personnel_id', 'first_name_th']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    // Export without filter
    $response = $this->getJson('/api/v1/personnel/export?format=csv');
    $content = $response->streamedContent();
    expect(count(explode("\n", trim($content))))->toBe(3); // 1 header + 2 rows (Alice, Bob)

    // Export with structure_id filter (Bob has STR1)
    $response = $this->getJson('/api/v1/personnel/export?format=csv&structure_id=STR1');
    $response->assertOk();
    $content = $response->streamedContent();
    $lines = explode("\n", trim($content));

    expect(count($lines))->toBe(2); // 1 header + 1 row (Bob)
    expect($lines[1])->toContain('P002'); // Bob's ID
    expect($lines[1])->not->toContain('P001'); // Alice's ID
});
