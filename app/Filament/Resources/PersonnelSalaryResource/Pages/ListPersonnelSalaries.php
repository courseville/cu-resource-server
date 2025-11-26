<?php

namespace App\Filament\Resources\PersonnelSalaryResource\Pages;

use App\Filament\Resources\PersonnelSalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelSalaries extends ListRecords
{
    protected static string $resource = PersonnelSalaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
