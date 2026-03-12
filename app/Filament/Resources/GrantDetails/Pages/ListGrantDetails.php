<?php

namespace App\Filament\Resources\GrantDetails\Pages;

use App\Filament\Exports\Resources\GrantDetailExporter;

use App\Filament\Imports\Resources\GrantDetailImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\GrantDetails\GrantDetailResource;
use Filament\Actions;
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
