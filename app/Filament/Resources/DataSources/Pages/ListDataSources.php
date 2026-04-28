<?php

namespace App\Filament\Resources\DataSources\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\DataSourceExporter;
use App\Filament\Imports\DataSourceImporter;
use App\Filament\Resources\DataSources\DataSourceResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListDataSources extends ListRecords
{
    protected static string $resource = DataSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(DataSourceExporter::class),
            ExcelImportAction::make()
                ->importer(DataSourceImporter::class),
            CreateAction::make(),
        ];
    }
}
