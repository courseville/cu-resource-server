<?php

namespace App\Filament\Resources\PersonnelStructures\Pages;

use App\Filament\Exports\Resources\StructureExporter;

use App\Filament\Imports\Resources\StructureImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\PersonnelStructures\PersonnelStructureResource;
use Filament\Actions;
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
