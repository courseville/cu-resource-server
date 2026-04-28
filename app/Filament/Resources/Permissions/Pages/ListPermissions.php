<?php

namespace App\Filament\Resources\Permissions\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PermissionExporter;
use App\Filament\Imports\PermissionImporter;
use App\Filament\Resources\Permissions\PermissionResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(PermissionExporter::class),
            ExcelImportAction::make()
                ->importer(PermissionImporter::class),
            CreateAction::make(),
        ];
    }
}
