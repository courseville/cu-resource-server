<?php

namespace App\Filament\Resources\PersonnelSalaries\Pages;

use App\Filament\Resources\PersonnelSalaries\PersonnelSalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonnelSalary extends CreateRecord
{
    protected static string $resource = PersonnelSalaryResource::class;
}
