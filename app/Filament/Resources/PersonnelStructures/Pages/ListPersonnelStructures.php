<?php

namespace App\Filament\Resources\PersonnelStructures\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\PersonnelStructures\PersonnelStructureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelStructures extends ListRecords
{
    protected static string $resource = PersonnelStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
