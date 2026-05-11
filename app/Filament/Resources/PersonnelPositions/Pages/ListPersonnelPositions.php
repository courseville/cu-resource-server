<?php

namespace App\Filament\Resources\PersonnelPositions\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelPositionExporter;
use App\Filament\Imports\PersonnelPositionImporter;
use App\Filament\Resources\PersonnelPositions\PersonnelPositionResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelPositions extends ListRecords
{
    protected static string $resource = PersonnelPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelPositionExporter::class),
            ExcelImportAction::make()->importer(PersonnelPositionImporter::class),
            CreateAction::make(),
        ];
    }
}
