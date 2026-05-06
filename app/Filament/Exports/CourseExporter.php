<?php

namespace App\Filament\Exports;

use App\Models\Resources\Course;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CourseExporter extends Exporter
{
    protected static ?string $model = Course::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('course_id'),
            ExportColumn::make('course_no'),
            ExportColumn::make('program_id'),
            ExportColumn::make('revision_year'),
            ExportColumn::make('name_th')->label('Name (Thai)'),
            ExportColumn::make('name_en')->label('Name (English)'),
            ExportColumn::make('name_abbr')->label('Abbreviated Name'),
            ExportColumn::make('credits'),
            ExportColumn::make('l_credit')->label('Lecture Credits'),
            ExportColumn::make('nl_credit')->label('Non-Lecture Credits'),
            ExportColumn::make('l_hour')->label('Lecture Hours'),
            ExportColumn::make('nl_hour')->label('Non-Lecture Hours'),
            ExportColumn::make('s_hour')->label('Self-Study Hours'),
            ExportColumn::make('description_th')->label('Description (Thai)'),
            ExportColumn::make('description_en')->label('Description (English)'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your course export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
