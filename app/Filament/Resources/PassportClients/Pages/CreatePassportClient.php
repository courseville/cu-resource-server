<?php

namespace App\Filament\Resources\PassportClients\Pages;

use App\Filament\Resources\PassportClients\PassportClientResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreatePassportClient extends CreateRecord
{
    protected static string $resource = PassportClientResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['secret'] = Str::random(40);
        $data['redirect'] ??= '';

        return $data;
    }

    protected function afterCreate(): void
    {
        PassportClientResource::syncPersonalAccessClient($this->record);

        $plainSecret = $this->record->plainSecret;

        if (! $plainSecret) {
            return;
        }

        Notification::make()
            ->title('Client secret generated')
            ->body("Copy this secret now — it will not be shown again:\n\n{$plainSecret}")
            ->success()
            ->persistent()
            ->send();
    }
}
