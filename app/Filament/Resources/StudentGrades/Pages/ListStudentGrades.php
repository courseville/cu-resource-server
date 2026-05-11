<?php

namespace App\Filament\Resources\StudentGrades\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\StudentGradeExporter;
use App\Filament\Imports\StudentGradeImporter;
use App\Filament\Resources\StudentGrades\StudentGradeResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentGrades extends ListRecords
{
    protected static string $resource = StudentGradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(StudentGradeExporter::class),
            ExcelImportAction::make()->importer(StudentGradeImporter::class),
            CreateAction::make(),
        ];
    }
}
