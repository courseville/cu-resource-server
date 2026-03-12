<?php

namespace App\Filament\Resources\Curriculums\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CurriculumExporter;
use App\Filament\Imports\Resources\CurriculumImporter;
use App\Filament\Resources\Curriculums\CurriculumResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListCurriculums extends ListRecords
{
    protected static string $resource = CurriculumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(CurriculumExporter::class),
            ExcelImportAction::make()
                ->importer(CurriculumImporter::class),
            CreateAction::make(),
        ];
    }
}
