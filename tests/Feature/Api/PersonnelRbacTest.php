<?php

use App\Models\Resources\Personnel;
use App\Models\Resources\Structure;
use App\Models\Resources\StructureProfile;

beforeEach(function () {
    Personnel::create([
        'personnel_id' => 'P001',
        'first_name_th' => 'Ananda',
        'last_name_th' => 'Sukmuang',
        'first_name_en' => 'Ananda',
        'last_name_en' => 'Sukmuang',
    ]);
    Personnel::create([
        'personnel_id' => 'P002',
        'first_name_th' => 'Buranee',
        'last_name_th' => 'Pongsri',
        'first_name_en' => 'Buranee',
        'last_name_en' => 'Pongsri',
    ]);
});

it('returns 401 when no client credentials are presented', function () {
    $response = $this->getJson('/api/v1/personnel');

    $response->assertStatus(401);
});

it('returns 403 when the client has no view permission for Personnel', function () {
    $client = makeOauthClient();
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/personnel');

    $response->assertStatus(403);
});

it('returns rows with only permitted columns populated', function () {
    $client = makeOauthClient();
    $permission = makePermission(Personnel::class, ['personnel_id', 'first_name_th']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/personnel');

    $response->assertOk();
    $row = $response->json('data.0');
    expect($row['personnel_id'])->not->toBeNull()
        ->and($row['first_name_th'])->not->toBeNull()
        ->and($row['last_name_th'])->toBeNull();
});

it('returns the specified personnel via personnel_id route binding', function () {
    $client = makeOauthClient();
    $permission = makePermission(Personnel::class, ['personnel_id', 'first_name_th']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/personnel/P001');

    $response->assertOk()
        ->assertJsonPath('data.personnel_id', 'P001');
});

it('returns 404 when the personnel_id does not exist', function () {
    $client = makeOauthClient();
    $permission = makePermission(Personnel::class, ['personnel_id']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/personnel/DOES_NOT_EXIST');

    $response->assertStatus(404);
});

it('returns empty when filtering by a non-existent structure_id', function () {
    $client = makeOauthClient();
    $permission = makePermission(Personnel::class, ['personnel_id']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/personnel?structure_id=NOPE');

    $response->assertOk()
        ->assertJsonCount(0, 'data');
});

it('returns only personnel attached to a matching structure when filtered by structure_id', function () {
    $structure = Structure::create(['structure_id' => 'STR-1', 'name' => 'Engineering']);
    $personnel = Personnel::where('personnel_id', 'P001')->first();
    StructureProfile::create([
        'personnel_id' => $personnel->id,
        'structure_level1_id' => $structure->id,
    ]);

    $client = makeOauthClient();
    $permission = makePermission(Personnel::class, ['personnel_id', 'first_name_th']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/personnel?structure_id=STR-1');

    $response->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.personnel_id', 'P001');
});
