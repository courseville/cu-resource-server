<?php

namespace App\Filament\Resources\PersonnelContractInfos\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PersonnelContractInfoExporter;
use App\Filament\Imports\PersonnelContractInfoImporter;
use App\Filament\Resources\PersonnelContractInfos\PersonnelContractInfoResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelContractInfos extends ListRecords
{
    protected static string $resource = PersonnelContractInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(PersonnelContractInfoExporter::class),
            ExcelImportAction::make()->importer(PersonnelContractInfoImporter::class),
            CreateAction::make(),
        ];
    }
}
