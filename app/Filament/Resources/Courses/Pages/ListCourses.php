<?php

namespace App\Filament\Resources\Courses\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CourseExporter;
use App\Filament\Imports\Resources\CourseImporter;
use App\Filament\Resources\Courses\CourseResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(CourseExporter::class),
            ExcelImportAction::make()
                ->importer(CourseImporter::class),
            CreateAction::make(),
        ];
    }
}
