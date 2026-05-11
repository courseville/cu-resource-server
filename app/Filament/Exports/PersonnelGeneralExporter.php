<?php

namespace App\Filament\Exports;

use App\Models\Resources\PersonnelGeneral;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PersonnelGeneralExporter extends Exporter
{
    protected static ?string $model = PersonnelGeneral::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('personnel_id'),
            ExportColumn::make('begin_date'),
            ExportColumn::make('end_date'),
            ExportColumn::make('status_id'),
            ExportColumn::make('title_th'),
            ExportColumn::make('name_th'),
            ExportColumn::make('surname_th'),
            ExportColumn::make('title_en'),
            ExportColumn::make('name_en'),
            ExportColumn::make('surname_en'),
            ExportColumn::make('email'),
            ExportColumn::make('nation'),
            ExportColumn::make('citizen_id'),
            ExportColumn::make('passport_number'),
            ExportColumn::make('staff_group'),
            ExportColumn::make('personnel_grp_id'),
            ExportColumn::make('personnel_grp_name'),
            ExportColumn::make('personnel_subgrp_name'),
            ExportColumn::make('position_name'),
            ExportColumn::make('position_number'),
            ExportColumn::make('contract_type_id'),
            ExportColumn::make('contract_type_name'),
            ExportColumn::make('contract_end_date'),
            ExportColumn::make('btrtl'),
            ExportColumn::make('btrtl_text'),
            ExportColumn::make('stell'),
            ExportColumn::make('stell_text'),
            ExportColumn::make('ansvh'),
            ExportColumn::make('ansvh_text'),
            ExportColumn::make('organization_id'),
            ExportColumn::make('organization_name'),
            ExportColumn::make('structure_level1_name'),
            ExportColumn::make('structure_level2_name'),
            ExportColumn::make('structure_level3_name'),
            ExportColumn::make('structure_level4_name'),
            ExportColumn::make('employee_name'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your personnel general export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
