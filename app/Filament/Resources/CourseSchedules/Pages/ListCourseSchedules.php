<?php

namespace App\Filament\Resources\CourseSchedules\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CourseScheduleExporter;
use App\Filament\Imports\Resources\CourseScheduleImporter;
use App\Filament\Resources\CourseSchedules\CourseScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseSchedules extends ListRecords
{
    protected static string $resource = CourseScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(CourseScheduleExporter::class),
            ExcelImportAction::make()
                ->importer(CourseScheduleImporter::class),
            CreateAction::make(),
        ];
    }
}
