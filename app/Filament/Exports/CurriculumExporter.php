<?php

namespace App\Filament\Exports;

use App\Models\Resources\Curriculum;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CurriculumExporter extends Exporter
{
    protected static ?string $model = Curriculum::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('course_code_no'),
            ExportColumn::make('major_code'),
            ExportColumn::make('major'),
            ExportColumn::make('degree'),
            ExportColumn::make('no_year_study'),
            ExportColumn::make('begin_year'),
            ExportColumn::make('faccode'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your curriculum export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
