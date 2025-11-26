<?php

namespace App\Filament\Resources\RetiredPersonnelResource\Pages;

use App\Filament\Resources\RetiredPersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetiredPersonnels extends ListRecords
{
    protected static string $resource = RetiredPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
