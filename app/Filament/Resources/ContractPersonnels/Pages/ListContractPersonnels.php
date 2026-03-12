<?php

namespace App\Filament\Resources\ContractPersonnels\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\Resources\ContractPersonnelExporter;
use App\Filament\Imports\Resources\ContractPersonnelImporter;
use App\Filament\Resources\ContractPersonnels\ContractPersonnelResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListContractPersonnels extends ListRecords
{
    protected static string $resource = ContractPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(ContractPersonnelExporter::class),
            ExcelImportAction::make()
                ->importer(ContractPersonnelImporter::class),
            CreateAction::make(),
        ];
    }
}
