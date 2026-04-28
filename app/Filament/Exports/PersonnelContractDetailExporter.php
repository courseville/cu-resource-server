<?php

namespace App\Filament\Exports;

use App\Models\Resources\PersonnelContractDetail;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PersonnelContractDetailExporter extends Exporter
{
    protected static ?string $model = PersonnelContractDetail::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('personnel_id'),
            ExportColumn::make('begin_date'),
            ExportColumn::make('end_date'),
            ExportColumn::make('contract_type_id'),
            ExportColumn::make('contract_type_name'),
            ExportColumn::make('probation'),
            ExportColumn::make('probation_unit'),
            ExportColumn::make('contract_end_date'),
            ExportColumn::make('disemploy_employer'),
            ExportColumn::make('disemploy_employee'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your personnel contract detail export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
