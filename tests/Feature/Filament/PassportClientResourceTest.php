<?php

use App\Filament\Resources\PassportClients\Pages\CreatePassportClient;
use App\Filament\Resources\PassportClients\Pages\EditPassportClient;
use App\Filament\Resources\PassportClients\Pages\ListPassportClients;
use App\Models\Client;
use App\Models\User;
use Filament\Notifications\Notification;
use Laravel\Passport\Passport;
use Livewire\Livewire;

beforeEach(function () {
    // User::canAccessPanel() returns true when APP_ENV === 'local'. The test env
    // is 'testing', so override the runtime config to bypass the permission check.
    config(['app.env' => 'local']);

    $this->actingAs(User::factory()->create(), 'admin');
});

it('renders the list page', function () {
    Livewire::test(ListPassportClients::class)->assertOk();
});

it('renders the create page', function () {
    Livewire::test(CreatePassportClient::class)->assertOk();
});

it('creates a Client Credentials client without redirect or grant flags', function () {
    Livewire::test(CreatePassportClient::class)
        ->fillForm([
            'name' => 'Machine client',
            'redirect' => null,
            'personal_access_client' => false,
            'revoked' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $client = Client::firstWhere('name', 'Machine client');

    expect($client)->not->toBeNull()
        ->and($client->redirect)->toBe('')
        ->and($client->personal_access_client)->toBeFalse()
        ->and($client->password_client)->toBeFalse()
        ->and($client->revoked)->toBeFalse()
        ->and($client->secret)->not->toBeNull();

    expect(Passport::personalAccessClient()->where('client_id', $client->getKey())->exists())
        ->toBeFalse();
});

it('creates a Personal Access client and adds the oauth_personal_access_clients row', function () {
    Livewire::test(CreatePassportClient::class)
        ->fillForm([
            'name' => 'PAT issuer',
            'redirect' => null,
            'personal_access_client' => true,
            'revoked' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $client = Client::firstWhere('name', 'PAT issuer');

    expect($client->personal_access_client)->toBeTrue();
    expect(Passport::personalAccessClient()->where('client_id', $client->getKey())->exists())
        ->toBeTrue();
});

it('surfaces the plaintext secret in a notification after creation', function () {
    Livewire::test(CreatePassportClient::class)
        ->fillForm([
            'name' => 'Notify me',
            'redirect' => null,
            'personal_access_client' => false,
            'revoked' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    Notification::assertNotified('Client secret generated');
});

it('renders the edit page for an existing client', function () {
    $client = makeOauthClient('Editable');

    Livewire::test(EditPassportClient::class, ['record' => $client->getRouteKey()])
        ->assertFormSet([
            'name' => 'Editable',
        ]);
});

it('regenerates the client secret via the header action', function () {
    $client = makeOauthClient('To regenerate');
    $previousSecret = $client->secret;

    Livewire::test(EditPassportClient::class, ['record' => $client->getRouteKey()])
        ->callAction('regenerateSecret');

    Notification::assertNotified('Client secret regenerated');

    $client->refresh();
    expect($client->secret)->not->toBe($previousSecret)
        ->and($client->secret)->not->toBeNull();
});

it('enabling personal_access_client on edit adds the join-table row', function () {
    $client = makeOauthClient('Promote to PAT');

    expect(Passport::personalAccessClient()->where('client_id', $client->getKey())->exists())
        ->toBeFalse();

    Livewire::test(EditPassportClient::class, ['record' => $client->getRouteKey()])
        ->fillForm([
            'name' => $client->name,
            'redirect' => $client->redirect,
            'personal_access_client' => true,
            'revoked' => false,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(Passport::personalAccessClient()->where('client_id', $client->getKey())->exists())
        ->toBeTrue();
});

it('disabling personal_access_client on edit removes the join-table row', function () {
    $client = makeOauthClient('Demote from PAT');
    $client->personal_access_client = true;
    $client->save();
    $row = Passport::personalAccessClient();
    $row->client_id = $client->getKey();
    $row->save();

    Livewire::test(EditPassportClient::class, ['record' => $client->getRouteKey()])
        ->fillForm([
            'name' => $client->name,
            'redirect' => $client->redirect,
            'personal_access_client' => false,
            'revoked' => false,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(Passport::personalAccessClient()->where('client_id', $client->getKey())->exists())
        ->toBeFalse();
});
