<?php

namespace App\Filament\Resources\PersonnelStructureResource\Pages;

use App\Filament\Resources\PersonnelStructureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelStructures extends ListRecords
{
    protected static string $resource = PersonnelStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
