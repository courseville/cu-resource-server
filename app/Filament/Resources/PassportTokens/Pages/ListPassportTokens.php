<?php

namespace App\Filament\Resources\PassportTokens\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\PassportTokenExporter;
use App\Filament\Imports\PassportTokenImporter;
use Filament\Actions\CreateAction;
use App\Filament\Resources\PassportTokens\PassportTokenResource;
use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListPassportTokens extends ListRecords
{
    protected static string $resource = PassportTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(PassportTokenExporter::class),
            ExcelImportAction::make()
                ->importer(PassportTokenImporter::class),
            CreateAction::make(),
        ];
    }
}
