<?php

namespace App\Filament\Exports\Resources;

use App\Models\Resources\Portfolio;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PortfolioExporter extends Exporter
{
    protected static ?string $model = Portfolio::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('application_id'),
            ExportColumn::make('signature'),
            ExportColumn::make('email'),
            ExportColumn::make('phone_number'),
            ExportColumn::make('picture'),
            ExportColumn::make('intro_video'),
            ExportColumn::make('work'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your portfolio export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
