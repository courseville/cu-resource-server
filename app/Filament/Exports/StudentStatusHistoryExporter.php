<?php

namespace App\Filament\Exports;

use App\Models\Resources\StudentStatusHistory;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StudentStatusHistoryExporter extends Exporter
{
    protected static ?string $model = StudentStatusHistory::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('student_code'),
            ExportColumn::make('name_thai')->label('Name (Thai)'),
            ExportColumn::make('name_english')->label('Name (English)'),
            ExportColumn::make('status'),
            ExportColumn::make('effect_date'),
            ExportColumn::make('from_acad_year')->label('From Academic Year'),
            ExportColumn::make('from_semester'),
            ExportColumn::make('to_acad_year')->label('To Academic Year'),
            ExportColumn::make('to_semester'),
            ExportColumn::make('instruction_no')->label('Instruction No.'),
            ExportColumn::make('announcement'),
            ExportColumn::make('faccode')->label('Faculty Code'),
            ExportColumn::make('depcode')->label('Department Code'),
            ExportColumn::make('majorcode')->label('Major Code'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student status history export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
