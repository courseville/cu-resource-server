<?php

namespace App\Filament\Exports;

use App\Models\Resources\StudentGrade;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class StudentGradeExporter extends Exporter
{
    protected static ?string $model = StudentGrade::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('student_code'),
            ExportColumn::make('year'),
            ExportColumn::make('semester'),
            ExportColumn::make('course_code'),
            ExportColumn::make('total_credit'),
            ExportColumn::make('grade'),
            ExportColumn::make('last_update'),
            ExportColumn::make('faccode'),
            ExportColumn::make('depcode'),
            ExportColumn::make('majorcode'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student grade export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
