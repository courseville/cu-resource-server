<?php

namespace App\Filament\Resources\PersonnelSalaryResource\Pages;

use App\Filament\Resources\PersonnelSalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelSalary extends EditRecord
{
    protected static string $resource = PersonnelSalaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
