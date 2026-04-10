<?php

namespace App\Filament\Resources\PersonnelContractDetails\Pages;

use App\Filament\Resources\PersonnelContractDetails\PersonnelContractDetailResource;
use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelContractDetailExporter;
use App\Filament\Imports\PersonnelContractDetailImporter;
use Filament\Actions\ExportAction;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelContractDetails extends ListRecords
{
    protected static string $resource = PersonnelContractDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelContractDetailExporter::class),
            ExcelImportAction::make()->importer(PersonnelContractDetailImporter::class),
            CreateAction::make(),
        ];
    }
}
