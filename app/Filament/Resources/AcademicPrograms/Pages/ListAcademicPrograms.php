<?php

namespace App\Filament\Resources\AcademicPrograms\Pages;

use App\Filament\Exports\AcademicProgramExporter;

use App\Filament\Imports\Resources\AcademicProgramImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use App\Filament\Resources\AcademicPrograms\AcademicProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademicPrograms extends ListRecords
{
    protected static string $resource = AcademicProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(AcademicProgramExporter::class),
            ExcelImportAction::make()
                ->importer(AcademicProgramImporter::class),
CreateAction::make(),
        ];
    }
}
