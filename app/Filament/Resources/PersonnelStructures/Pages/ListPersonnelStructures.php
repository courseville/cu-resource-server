<?php

namespace App\Filament\Resources\PersonnelStructures\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\Resources\StructureExporter;
use App\Filament\Imports\Resources\StructureImporter;
use App\Filament\Resources\PersonnelStructures\PersonnelStructureResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelStructures extends ListRecords
{
    protected static string $resource = PersonnelStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(StructureExporter::class),
            ExcelImportAction::make()
                ->importer(StructureImporter::class),
            CreateAction::make(),
        ];
    }
}
