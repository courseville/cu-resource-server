<?php

namespace App\Filament\Resources\FulltimePersonnels\Pages;

use App\Filament\Exports\Resources\FulltimePersonnelExporter;

use App\Filament\Imports\Resources\FulltimePersonnelImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\FulltimePersonnels\FulltimePersonnelResource;
use Filament\Actions;
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
