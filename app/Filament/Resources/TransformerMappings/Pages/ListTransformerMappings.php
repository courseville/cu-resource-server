<?php

namespace App\Filament\Resources\TransformerMappings\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\TransformerMappingExporter;
use App\Filament\Imports\TransformerMappingImporter;
use App\Filament\Resources\TransformerMappings\TransformerMappingResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
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
