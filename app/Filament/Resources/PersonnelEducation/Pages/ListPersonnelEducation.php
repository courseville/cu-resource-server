<?php

namespace App\Filament\Resources\PersonnelEducation\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelEducationExporter;
use App\Filament\Imports\PersonnelEducationImporter;
use App\Filament\Resources\PersonnelEducation\PersonnelEducationResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelEducation extends ListRecords
{
    protected static string $resource = PersonnelEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelEducationExporter::class),
            ExcelImportAction::make()->importer(PersonnelEducationImporter::class),
            CreateAction::make(),
        ];
    }
}
