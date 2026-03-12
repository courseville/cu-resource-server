<?php

namespace App\Filament\Exports\Resources;

use App\Models\Resources\Personnel;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PersonnelExporter extends Exporter
{
    protected static ?string $model = Personnel::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('personnel_id'),
            ExportColumn::make('title_th'),
            ExportColumn::make('first_name_th'),
            ExportColumn::make('last_name_th'),
            ExportColumn::make('title_en'),
            ExportColumn::make('first_name_en'),
            ExportColumn::make('last_name_en'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('public_email'),
            ExportColumn::make('private_email'),
            ExportColumn::make('phone_no'),
            ExportColumn::make('telephone_no'),
            ExportColumn::make('website'),
            ExportColumn::make('building'),
            ExportColumn::make('floor'),
            ExportColumn::make('room'),
            ExportColumn::make('registered_address'),
            ExportColumn::make('registered_sub_district'),
            ExportColumn::make('registered_district'),
            ExportColumn::make('registered_province'),
            ExportColumn::make('registered_postal_code'),
            ExportColumn::make('current_address'),
            ExportColumn::make('current_sub_district'),
            ExportColumn::make('current_district'),
            ExportColumn::make('current_province'),
            ExportColumn::make('current_postal_code'),
            ExportColumn::make('passport_no'),
            ExportColumn::make('faccode'),
            ExportColumn::make('depcode'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your personnel export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
