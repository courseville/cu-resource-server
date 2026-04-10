<?php

namespace App\Filament\Exports;

use App\Models\Resources\PersonnelPosition;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PersonnelPositionExporter extends Exporter
{
    protected static ?string $model = PersonnelPosition::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('personnel_id'),
            ExportColumn::make('begin_date'),
            ExportColumn::make('end_date'),
            ExportColumn::make('positiontype_id'),
            ExportColumn::make('positiontype_name'),
            ExportColumn::make('positiontype_text'),
            ExportColumn::make('fieldstudy'),
            ExportColumn::make('subdiscipline_1'),
            ExportColumn::make('subdiscipline_2'),
            ExportColumn::make('subdiscipline_3'),
            ExportColumn::make('subdiscipline_4'),
            ExportColumn::make('subdiscipline_5'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your personnel position export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
