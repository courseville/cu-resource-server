<?php

namespace App\Filament\Resources\PersonnelSalaries\Pages;

use App\Filament\Exports\Resources\PersonnelSalaryExporter;

use App\Filament\Imports\Resources\PersonnelSalaryImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

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
            ExportAction::make()
                ->exporter(PersonnelSalaryExporter::class),
            ExcelImportAction::make()
                ->importer(PersonnelSalaryImporter::class),
CreateAction::make(),
        ];
    }
}
