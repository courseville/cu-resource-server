<?php

namespace App\Filament\Resources\PersonnelProfiles\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelProfileExporter;
use App\Filament\Imports\PersonnelProfileImporter;
use App\Filament\Resources\PersonnelProfiles\PersonnelProfileResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelProfiles extends ListRecords
{
    protected static string $resource = PersonnelProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelProfileExporter::class),
            ExcelImportAction::make()->importer(PersonnelProfileImporter::class),
            CreateAction::make(),
        ];
    }
}
