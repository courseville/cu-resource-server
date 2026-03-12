<?php

namespace App\Filament\Resources\TransformerMappings\Pages;

use App\Filament\Exports\TransformerMappingExporter;

use App\Filament\Imports\TransformerMappingImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\TransformerMappings\TransformerMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransformerMappings extends ListRecords
{
    protected static string $resource = TransformerMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(TransformerMappingExporter::class),
            ExcelImportAction::make()
                ->importer(TransformerMappingImporter::class),
CreateAction::make(),
        ];
    }
}
