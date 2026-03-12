<?php

namespace App\Filament\Resources\StudentGraduations\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\StudentGraduationExporter;
use App\Filament\Imports\Resources\StudentGraduationImporter;
use App\Filament\Resources\StudentGraduations\StudentGraduationResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentGraduations extends ListRecords
{
    protected static string $resource = StudentGraduationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(StudentGraduationExporter::class),
            ExcelImportAction::make()
                ->importer(StudentGraduationImporter::class),
            CreateAction::make(),
        ];
    }
}
