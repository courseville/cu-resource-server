<?php

namespace App\Filament\Resources\CourseInstructors\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CourseInstructorExporter;
use App\Filament\Imports\Resources\CourseInstructorImporter;
use App\Filament\Resources\CourseInstructors\CourseInstructorResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseInstructors extends ListRecords
{
    protected static string $resource = CourseInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(CourseInstructorExporter::class),
            ExcelImportAction::make()
                ->importer(CourseInstructorImporter::class),
            CreateAction::make(),
        ];
    }
}
