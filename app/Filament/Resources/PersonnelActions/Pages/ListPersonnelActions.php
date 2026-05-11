<?php

namespace App\Filament\Resources\PersonnelActions\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelActionExporter;
use App\Filament\Imports\PersonnelActionImporter;
use App\Filament\Resources\PersonnelActions\PersonnelActionResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelActions extends ListRecords
{
    protected static string $resource = PersonnelActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelActionExporter::class),
            ExcelImportAction::make()->importer(PersonnelActionImporter::class),
            CreateAction::make(),
        ];
    }
}
