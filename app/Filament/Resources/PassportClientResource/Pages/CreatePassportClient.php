<?php

namespace App\Filament\Resources\PassportClientResource\Pages;

use App\Filament\Resources\PassportClientResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Laravel\Passport\Client;

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
