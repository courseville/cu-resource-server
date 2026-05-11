<?php

namespace App\Filament\Exports;

use App\Models\Resources\PersonnelProfile;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PersonnelProfileExporter extends Exporter
{
    protected static ?string $model = PersonnelProfile::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('personnel_id'),
            ExportColumn::make('begin_date'),
            ExportColumn::make('end_date'),
            ExportColumn::make('title_id'),
            ExportColumn::make('title_th'),
            ExportColumn::make('name_th'),
            ExportColumn::make('surname_th'),
            ExportColumn::make('gender'),
            ExportColumn::make('birth_date'),
            ExportColumn::make('rank_title'),
            ExportColumn::make('doctoral_title'),
            ExportColumn::make('acad_title_1'),
            ExportColumn::make('acad_title_2'),
            ExportColumn::make('title_by_the_king'),
            ExportColumn::make('nation'),
            ExportColumn::make('marrital_status'),
            ExportColumn::make('email'),
            ExportColumn::make('title_en'),
            ExportColumn::make('name_en'),
            ExportColumn::make('surname_en'),
            ExportColumn::make('citizen_id'),
            ExportColumn::make('passport_number'),
            ExportColumn::make('office_phonenumber'),
            ExportColumn::make('full_title'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your personnel profile export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
