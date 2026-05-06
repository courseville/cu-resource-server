<?php

namespace App\Filament\Exports;

use App\Models\Resources\StudentAdmission;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StudentAdmissionExporter extends Exporter
{
    protected static ?string $model = StudentAdmission::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('student_code'),
            ExportColumn::make('name_thai')->label('Name (Thai)'),
            ExportColumn::make('name_english')->label('Name (English)'),
            ExportColumn::make('admission_type'),
            ExportColumn::make('apply_year'),
            ExportColumn::make('apply_semester'),
            ExportColumn::make('apply_date'),
            ExportColumn::make('apply_status'),
            ExportColumn::make('faccode')->label('Faculty Code'),
            ExportColumn::make('depcode')->label('Department Code'),
            ExportColumn::make('majorcode')->label('Major Code'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student admission export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
