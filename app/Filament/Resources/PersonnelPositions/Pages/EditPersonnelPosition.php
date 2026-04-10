<?php

namespace App\Filament\Resources\PersonnelPositions\Pages;

use App\Filament\Resources\PersonnelPositions\PersonnelPositionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelPosition extends EditRecord
{
    protected static string $resource = PersonnelPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
