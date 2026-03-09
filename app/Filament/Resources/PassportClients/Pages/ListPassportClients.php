<?php

namespace App\Filament\Resources\PassportClients\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\PassportClients\PassportClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPassportClients extends ListRecords
{
    protected static string $resource = PassportClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
