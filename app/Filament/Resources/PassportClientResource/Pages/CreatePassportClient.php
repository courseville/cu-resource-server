<?php

namespace App\Filament\Resources\PassportClientResource\Pages;

use App\Filament\Resources\PassportClientResource;
use Filament\Resources\Pages\CreateRecord;
use Laravel\Passport\Client;
use Illuminate\Support\Str;

class CreatePassportClient extends CreateRecord
{
    protected static string $resource = PassportClientResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Generate a random client secret
        $clientSecret = Str::random(40);

        // Create a new Passport client
        $client = Client::create([
            'name' => $data['name'],
            'redirect' => $data['redirect'],
            'secret' => $clientSecret, // Store generated secret
            'personal_access_client' => $data['personal_access_client'] ?? false,
            'password_client' => $data['password_client'] ?? false,
            'revoked' => false,
        ]);

        // Store generated secret in data (optional for UI display)
        $data['generated_secret'] = $clientSecret;

        return $data;
    }
}
