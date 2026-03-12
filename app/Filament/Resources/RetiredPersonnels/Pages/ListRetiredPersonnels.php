<?php

namespace App\Filament\Resources\RetiredPersonnels\Pages;

use App\Filament\Exports\Resources\RetiredPersonnelExporter;

use App\Filament\Imports\Resources\RetiredPersonnelImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\RetiredPersonnels\RetiredPersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetiredPersonnels extends ListRecords
{
    protected static string $resource = RetiredPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(RetiredPersonnelExporter::class),
            ExcelImportAction::make()
                ->importer(RetiredPersonnelImporter::class),
CreateAction::make(),
        ];
    }
}
