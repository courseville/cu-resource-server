<?php

namespace App\Filament\Resources\FulltimePersonnels\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\Resources\FulltimePersonnelExporter;
use App\Filament\Imports\Resources\FulltimePersonnelImporter;
use App\Filament\Resources\FulltimePersonnels\FulltimePersonnelResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListFulltimePersonnels extends ListRecords
{
    protected static string $resource = FulltimePersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(FulltimePersonnelExporter::class),
            ExcelImportAction::make()
                ->importer(FulltimePersonnelImporter::class),
            CreateAction::make(),
        ];
    }
}
