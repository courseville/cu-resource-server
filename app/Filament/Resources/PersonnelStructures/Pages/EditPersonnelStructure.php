<?php

namespace App\Filament\Resources\PersonnelStructures\Pages;

use App\Filament\Resources\PersonnelStructures\PersonnelStructureResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelStructure extends EditRecord
{
    protected static string $resource = PersonnelStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
