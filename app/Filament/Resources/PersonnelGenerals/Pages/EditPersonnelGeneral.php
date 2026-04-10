<?php

namespace App\Filament\Resources\PersonnelGenerals\Pages;

use App\Filament\Resources\PersonnelGenerals\PersonnelGeneralResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelGeneral extends EditRecord
{
    protected static string $resource = PersonnelGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
