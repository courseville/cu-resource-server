<?php

namespace App\Filament\Exports;

use App\Models\Resources\CourseInstructor;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CourseInstructorExporter extends Exporter
{
    protected static ?string $model = CourseInstructor::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('course_code'),
            ExportColumn::make('section'),
            ExportColumn::make('instructor_no'),
            ExportColumn::make('instructor_name'),
            ExportColumn::make('acad_year'),
            ExportColumn::make('semester'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your course instructor export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
