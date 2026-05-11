<?php

namespace App\Filament\Resources\PersonnelImages\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelImageExporter;
use App\Filament\Imports\PersonnelImageImporter;
use App\Filament\Resources\PersonnelImages\PersonnelImageResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelImages extends ListRecords
{
    protected static string $resource = PersonnelImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelImageExporter::class),
            ExcelImportAction::make()->importer(PersonnelImageImporter::class),
            CreateAction::make(),
        ];
    }
}
