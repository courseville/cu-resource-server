<?php

namespace App\Filament\Resources\GrantDetails\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\Resources\GrantDetailExporter;
use App\Filament\Imports\Resources\GrantDetailImporter;
use App\Filament\Resources\GrantDetails\GrantDetailResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListGrantDetails extends ListRecords
{
    protected static string $resource = GrantDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(GrantDetailExporter::class),
            ExcelImportAction::make()
                ->importer(GrantDetailImporter::class),
            CreateAction::make(),
        ];
    }
}
