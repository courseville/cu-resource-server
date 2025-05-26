<?php

namespace App\Filament\Resources\PersonnelStructureResource\Pages;

use App\Filament\Resources\PersonnelStructureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelStructure extends EditRecord
{
    protected static string $resource = PersonnelStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
