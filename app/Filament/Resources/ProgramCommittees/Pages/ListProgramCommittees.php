<?php

namespace App\Filament\Resources\ProgramCommittees\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\ProgramCommitteeExporter;
use App\Filament\Imports\Resources\ProgramCommitteeImporter;
use App\Filament\Resources\ProgramCommittees\ProgramCommitteeResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramCommittees extends ListRecords
{
    protected static string $resource = ProgramCommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(ProgramCommitteeExporter::class),
            ExcelImportAction::make()
                ->importer(ProgramCommitteeImporter::class),
            CreateAction::make(),
        ];
    }
}
