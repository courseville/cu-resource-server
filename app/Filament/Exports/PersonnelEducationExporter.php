<?php

namespace App\Filament\Exports;

use App\Models\Resources\PersonnelEducation;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PersonnelEducationExporter extends Exporter
{
    protected static ?string $model = PersonnelEducation::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('personnel_id'),
            ExportColumn::make('begin_date'),
            ExportColumn::make('end_date'),
            ExportColumn::make('education_level_id'),
            ExportColumn::make('education_level_name'),
            ExportColumn::make('institution_id'),
            ExportColumn::make('institution_name'),
            ExportColumn::make('major_id'),
            ExportColumn::make('major_name'),
            ExportColumn::make('degree_id'),
            ExportColumn::make('degree_name'),
            ExportColumn::make('nation_id'),
            ExportColumn::make('nation_name_th'),
            ExportColumn::make('distinction_id'),
            ExportColumn::make('distinction_name'),
            ExportColumn::make('highest_education'),
            ExportColumn::make('highest_education_th'),
            ExportColumn::make('employ_education_id'),
            ExportColumn::make('employ_education_name'),
            ExportColumn::make('graduate_date'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your personnel education export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
