<?php

namespace App\Filament\Resources\PersonnelRetireds\Pages;

use App\Filament\Resources\PersonnelRetireds\PersonnelRetiredResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelRetired extends EditRecord
{
    protected static string $resource = PersonnelRetiredResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
