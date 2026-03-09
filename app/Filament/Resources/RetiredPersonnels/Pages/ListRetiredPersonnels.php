<?php

namespace App\Filament\Resources\RetiredPersonnels\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\RetiredPersonnels\RetiredPersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetiredPersonnels extends ListRecords
{
    protected static string $resource = RetiredPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
