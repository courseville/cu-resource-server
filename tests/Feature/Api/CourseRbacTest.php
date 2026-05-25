<?php

use App\Models\Resources\Course;
use Illuminate\Support\Carbon;

beforeEach(function () {
    Carbon::setTestNow('2026-05-11 11:13:29');

    Course::create([
        'code' => 'CSE101',
        'name' => 'Introduction to Computer Science',
        'credits' => 3,
        'faccode' => 'TEST',
        'name_th' => 'วิทยาการคอมพิวเตอร์เบื้องต้น',
        'name_en' => 'Introduction to Computer Science',
    ]);

    Course::create([
        'code' => 'MTH102',
        'name' => 'Calculus I',
        'credits' => 4,
        'faccode' => 'TEST',
        'name_th' => 'แคลคูลัส 1',
        'name_en' => 'Calculus I',
    ]);
});

it('returns 401 when no client credentials are presented', function () {
    $response = $this->getJson('/api/v1/courses');

    $response->assertStatus(401);
});

it('returns 403 when the client has no view permission for Course', function () {
    $client = makeOauthClient();
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/courses');

    $response->assertStatus(403);
});

it('returns paginated rows with only the columns the client is permitted to see', function () {
    $client = makeOauthClient();
    $permission = makePermission(Course::class, ['code', 'name']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/courses');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                ['code', 'name'],
            ],
            'links',
            'meta',
        ]);

    $row = $response->json('data.0');
    expect($row['code'])->not->toBeNull()
        ->and($row['name'])->not->toBeNull()
        ->and($row['credits'] ?? null)->toBeNull(); // since credits wasn't selected / permitted
});

it('returns single course with permitted columns', function () {
    $client = makeOauthClient();
    $permission = makePermission(Course::class, ['code', 'name', 'credits']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $course = Course::where('code', 'CSE101')->first();

    $response = $this->getJson("/api/v1/courses/{$course->id}");

    $response->assertOk()
        ->assertJsonStructure([
            'data' => ['code', 'name', 'credits'],
        ]);

    $data = $response->json('data');
    expect($data['code'])->toBe('CSE101')
        ->and($data['name'])->toBe('Introduction to Computer Science')
        ->and($data['credits'])->toBe(3);
});

it('exports courses to CSV for authorized clients', function () {
    $client = makeOauthClient();
    $permission = makePermission(Course::class, ['code', 'name']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/courses/export?format=csv');

    $response->assertOk();
    $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    $response->assertHeader('Content-Disposition', 'attachment; filename="course_20260511_111329.csv"');

    $content = $response->streamedContent();
    $lines = explode("\n", trim($content));

    // Header
    expect($lines[0])->toBe('code,name');

    // Data (2 rows)
    expect(count($lines))->toBe(3); // 1 header + 2 rows
});

it('filters course list by search query', function () {
    $client = makeOauthClient();
    $permission = makePermission(Course::class, ['code', 'name']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    // Search for "Calculus"
    $response = $this->getJson('/api/v1/courses?name=Calculus');

    $response->assertOk()
        ->assertJsonCount(1, 'data');

    expect($response->json('data.0.code'))->toBe('MTH102');
});
