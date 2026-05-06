<?php

namespace App\Filament\Exports;

use App\Models\Resources\StudentCurriculum;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StudentCurriculumExporter extends Exporter
{
    protected static ?string $model = StudentCurriculum::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('student_code'),
            ExportColumn::make('name_thai')->label('Name (Thai)'),
            ExportColumn::make('name_english')->label('Name (English)'),
            ExportColumn::make('year'),
            ExportColumn::make('semester'),
            ExportColumn::make('course_code'),
            ExportColumn::make('course_name'),
            ExportColumn::make('section'),
            ExportColumn::make('grade'),
            ExportColumn::make('credit_tot')->label('Total Credits'),
            ExportColumn::make('faccode')->label('Faculty Code'),
            ExportColumn::make('depcode')->label('Department Code'),
            ExportColumn::make('majorcode')->label('Major Code'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student curriculum export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
