<?php

namespace App\Filament\Resources\Personnels\Pages;

use App\Filament\Exports\Resources\PersonnelExporter;

use App\Filament\Imports\Resources\PersonnelImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Personnels\PersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonnels extends ListRecords
{
    protected static string $resource = PersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(PersonnelExporter::class),
            ExcelImportAction::make()
                ->importer(PersonnelImporter::class),
CreateAction::make(),
        ];
    }
}
