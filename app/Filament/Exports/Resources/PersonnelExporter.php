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
            ExportColumn::make('rank_title')->label('Rank Title'),
            ExportColumn::make('doctoral_title')->label('Doctoral Title'),
            ExportColumn::make('acad_title_1')->label('Academic Title 1'),
            ExportColumn::make('acad_title_2')->label('Academic Title 2'),
            ExportColumn::make('title_by_the_king')->label('Title By The King'),
            ExportColumn::make('citizen_id')->label('Citizen ID'),
            ExportColumn::make('birth_date')->label('Birth Date'),
            ExportColumn::make('marital_status')->label('Marital Status'),
            ExportColumn::make('personnel_type')->label('Personnel Type'),
            ExportColumn::make('personnel_status')->label('Personnel Status'),
            ExportColumn::make('personnel_subgroup')->label('Personnel Subgroup'),
            ExportColumn::make('position_name')->label('Position Name'),
            ExportColumn::make('position_number')->label('Position Number'),
            ExportColumn::make('start_date')->label('Start Date'),
            ExportColumn::make('structure_level1_name')->label('Structure Level 1'),
            ExportColumn::make('structure_level2_name')->label('Structure Level 2'),
            ExportColumn::make('structure_level3_name')->label('Structure Level 3'),
            ExportColumn::make('structure_level4_name')->label('Structure Level 4'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your personnel export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
