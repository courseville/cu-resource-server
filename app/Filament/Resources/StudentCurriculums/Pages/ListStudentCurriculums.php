<?php

namespace App\Filament\Resources\StudentCurriculums\Pages;

use App\Filament\Exports\StudentCurriculumExporter;

use App\Filament\Imports\Resources\StudentCurriculumImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use App\Filament\Resources\StudentCurriculums\StudentCurriculumResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentCurriculums extends ListRecords
{
    protected static string $resource = StudentCurriculumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(StudentCurriculumExporter::class),
            ExcelImportAction::make()
                ->importer(StudentCurriculumImporter::class),
CreateAction::make(),
        ];
    }
}
