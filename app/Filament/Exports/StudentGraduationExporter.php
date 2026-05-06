<?php

namespace App\Filament\Exports;

use App\Models\Resources\StudentGraduation;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StudentGraduationExporter extends Exporter
{
    protected static ?string $model = StudentGraduation::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('student_code'),
            ExportColumn::make('name_thai')->label('Name (Thai)'),
            ExportColumn::make('name_english')->label('Name (English)'),
            ExportColumn::make('acad_year')->label('Academic Year'),
            ExportColumn::make('semester'),
            ExportColumn::make('major_thai')->label('Major (Thai)'),
            ExportColumn::make('major_english')->label('Major (English)'),
            ExportColumn::make('degree_thai')->label('Degree (Thai)'),
            ExportColumn::make('degree_english')->label('Degree (English)'),
            ExportColumn::make('graduate_date'),
            ExportColumn::make('concil_date')->label('Council Date'),
            ExportColumn::make('distinction'),
            ExportColumn::make('faccode')->label('Faculty Code'),
            ExportColumn::make('depcode')->label('Department Code'),
            ExportColumn::make('majorcode')->label('Major Code'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student graduation export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
