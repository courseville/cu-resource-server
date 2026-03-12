<?php

namespace App\Filament\Exports;

use App\Models\Resources\Student;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class StudentExporter extends Exporter
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('student_id'),
            ExportColumn::make('title_th'),
            ExportColumn::make('first_name_th'),
            ExportColumn::make('last_name_th'),
            ExportColumn::make('title_en'),
            ExportColumn::make('first_name_en'),
            ExportColumn::make('last_name_en'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('national_id'),
            ExportColumn::make('birth'),
            ExportColumn::make('image'),
            ExportColumn::make('nationality'),
            ExportColumn::make('religion'),
            ExportColumn::make('blood'),
            ExportColumn::make('phone'),
            ExportColumn::make('email'),
            ExportColumn::make('current_address'),
            ExportColumn::make('current_district'),
            ExportColumn::make('current_province'),
            ExportColumn::make('current_zip_code'),
            ExportColumn::make('current_latitude'),
            ExportColumn::make('current_longitude'),
            ExportColumn::make('hometown_address'),
            ExportColumn::make('hometown_district'),
            ExportColumn::make('hometown_province'),
            ExportColumn::make('hometown_zip_code'),
            ExportColumn::make('hometown_latitude'),
            ExportColumn::make('hometown_longitude'),
            ExportColumn::make('father_first_name'),
            ExportColumn::make('father_last_name'),
            ExportColumn::make('father_birth_year'),
            ExportColumn::make('father_status'),
            ExportColumn::make('mother_first_name'),
            ExportColumn::make('mother_last_name'),
            ExportColumn::make('mother_birth_year'),
            ExportColumn::make('mother_status'),
            ExportColumn::make('parent_relationship'),
            ExportColumn::make('parent_phone'),
            ExportColumn::make('sibling_total'),
            ExportColumn::make('sibling_order'),
            ExportColumn::make('parent_address'),
            ExportColumn::make('parent_district'),
            ExportColumn::make('parent_province'),
            ExportColumn::make('parent_zip_code'),
            ExportColumn::make('parent_latitude'),
            ExportColumn::make('parent_longitude'),
            ExportColumn::make('full_name_th'),
            ExportColumn::make('full_name_en'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
