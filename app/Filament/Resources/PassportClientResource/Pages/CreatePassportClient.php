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
        // Store generated secret in data (optional for UI display)
        $data['secret'] = $clientSecret;

        return $data;
    }
}
