<?php

namespace App\Filament\Resources\Personnels\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Personnels\PersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonnels extends ListRecords
{
    protected static string $resource = PersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
