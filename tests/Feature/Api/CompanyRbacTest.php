<?php

use App\Models\Resources\Company;

beforeEach(function () {
    Company::create([
        'name' => 'Test Company',
        'address' => '123 Street',
        'admin_name' => 'John Doe',
    ]);
});

it('returns 401 when no client credentials are presented', function () {
    $response = $this->getJson('/api/v1/companies');

    $response->assertStatus(401);
});

it('returns 403 when the client has no view permission for Company', function () {
    $client = makeOauthClient();
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/companies');

    $response->assertStatus(403);
});

it('returns paginated rows with only the columns the client is permitted to see', function () {
    $client = makeOauthClient();
    $permission = makePermission(Company::class, ['name', 'address']);
    attachPermissionsToClient($client, [$permission]);
    actingAsApiClient($client);

    $response = $this->getJson('/api/v1/companies');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                ['name', 'address'],
            ],
        ]);

    $row = $response->json('data.0');
    expect($row['name'])->not->toBeNull()
        ->and($row['address'])->not->toBeNull()
        ->and($row['admin_name'])->toBeNull();
});
