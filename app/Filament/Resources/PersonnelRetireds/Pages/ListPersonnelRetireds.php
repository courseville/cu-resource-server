<?php

namespace App\Filament\Resources\PersonnelRetireds\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelRetiredExporter;
use App\Filament\Imports\PersonnelRetiredImporter;
use App\Filament\Resources\PersonnelRetireds\PersonnelRetiredResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelRetireds extends ListRecords
{
    protected static string $resource = PersonnelRetiredResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelRetiredExporter::class),
            ExcelImportAction::make()->importer(PersonnelRetiredImporter::class),
            CreateAction::make(),
        ];
    }
}
