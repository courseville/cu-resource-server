<?php

namespace App\Filament\Resources\PersonnelSalaries\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\PersonnelSalaries\PersonnelSalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelSalaries extends ListRecords
{
    protected static string $resource = PersonnelSalaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
