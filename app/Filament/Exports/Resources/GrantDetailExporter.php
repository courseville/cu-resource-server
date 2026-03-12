<?php

namespace App\Filament\Exports\Resources;

use App\Models\Resources\GrantDetail;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class GrantDetailExporter extends Exporter
{
    protected static ?string $model = GrantDetail::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('student_id'),
            ExportColumn::make('type'),
            ExportColumn::make('travel_cost'),
            ExportColumn::make('accommodation_cost'),
            ExportColumn::make('lump_sum_allowance'),
            ExportColumn::make('first_student_id'),
            ExportColumn::make('second_student_id'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your grant detail export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
