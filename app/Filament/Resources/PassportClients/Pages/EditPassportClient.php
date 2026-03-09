<?php

namespace App\Filament\Resources\PassportClients\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\PassportClients\PassportClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPassportClient extends EditRecord
{
    protected static string $resource = PassportClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
