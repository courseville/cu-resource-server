<?php

namespace App\Filament\Exports\Resources;

use App\Models\Resources\FulltimePersonnel;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class FulltimePersonnelExporter extends Exporter
{
    protected static ?string $model = FulltimePersonnel::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('personnel_id'),
            ExportColumn::make('full_time_id'),
            ExportColumn::make('university'),
            ExportColumn::make('degree'),
            ExportColumn::make('education_level'),
            ExportColumn::make('date_of_appointment'),
            ExportColumn::make('asst_prof_date'),
            ExportColumn::make('prof_date'),
            ExportColumn::make('assoc_prof_date'),
            ExportColumn::make('birth_date'),
            ExportColumn::make('age'),
            ExportColumn::make('personnel_status_changing_date'),
            ExportColumn::make('salary_band'),
            ExportColumn::make('teacher_date'),
            ExportColumn::make('job_type'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your fulltime personnel export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
