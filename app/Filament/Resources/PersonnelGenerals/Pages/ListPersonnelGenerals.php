<?php

namespace App\Filament\Resources\PersonnelGenerals\Pages;

use App\Filament\Resources\PersonnelGenerals\PersonnelGeneralResource;
use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelGeneralExporter;
use App\Filament\Imports\PersonnelGeneralImporter;
use Filament\Actions\ExportAction;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelGenerals extends ListRecords
{
    protected static string $resource = PersonnelGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelGeneralExporter::class),
            ExcelImportAction::make()->importer(PersonnelGeneralImporter::class),
            CreateAction::make(),
        ];
    }
}
