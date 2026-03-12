<?php

namespace App\Filament\Resources\PersonnelSalaries\Pages;

use App\Filament\Resources\PersonnelSalaries\PersonnelSalaryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelSalary extends EditRecord
{
    protected static string $resource = PersonnelSalaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
