<?php

namespace App\Filament\Resources\PassportClients\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PassportClientExporter;
use App\Filament\Imports\PassportClientImporter;
use App\Filament\Resources\PassportClients\PassportClientResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPassportClients extends ListRecords
{
    protected static string $resource = PassportClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(PassportClientExporter::class),
            ExcelImportAction::make()
                ->importer(PassportClientImporter::class),
            CreateAction::make(),
        ];
    }
}
