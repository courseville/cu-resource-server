<?php

namespace App\Filament\Resources\PassportTokens\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\PassportTokens\PassportTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPassportTokens extends ListRecords
{
    protected static string $resource = PassportTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
