<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\RoleExporter;
use App\Filament\Imports\RoleImporter;
use App\Filament\Resources\Roles\RoleResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(RoleExporter::class),
            ExcelImportAction::make()
                ->importer(RoleImporter::class),
            CreateAction::make(),
        ];
    }
}
