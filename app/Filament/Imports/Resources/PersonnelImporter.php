<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Personnel;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelImporter extends Importer
{
    protected static ?string $model = Personnel::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('title_th')
                ->rules(['max:255']),
            ImportColumn::make('first_name_th')
                ->rules(['max:255']),
            ImportColumn::make('last_name_th')
                ->rules(['max:255']),
            ImportColumn::make('title_en')
                ->rules(['max:255']),
            ImportColumn::make('first_name_en')
                ->rules(['max:255']),
            ImportColumn::make('last_name_en')
                ->rules(['max:255']),
            ImportColumn::make('public_email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('private_email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('phone_no')
                ->rules(['max:255']),
            ImportColumn::make('telephone_no')
                ->rules(['max:255']),
            ImportColumn::make('website')
                ->rules(['max:255']),
            ImportColumn::make('building')
                ->rules(['max:255']),
            ImportColumn::make('floor')
                ->rules(['max:255']),
            ImportColumn::make('room')
                ->rules(['max:255']),
            ImportColumn::make('registered_address'),
            ImportColumn::make('registered_sub_district')
                ->rules(['max:255']),
            ImportColumn::make('registered_district')
                ->rules(['max:255']),
            ImportColumn::make('registered_province')
                ->rules(['max:255']),
            ImportColumn::make('registered_postal_code')
                ->rules(['max:255']),
            ImportColumn::make('current_address'),
            ImportColumn::make('current_sub_district')
                ->rules(['max:255']),
            ImportColumn::make('current_district')
                ->rules(['max:255']),
            ImportColumn::make('current_province')
                ->rules(['max:255']),
            ImportColumn::make('current_postal_code')
                ->rules(['max:255']),
            ImportColumn::make('passport_no')
                ->rules(['max:255']),
            ImportColumn::make('faccode')
                ->rules(['max:255']),
            ImportColumn::make('depcode')
                ->rules(['max:255']),
            ImportColumn::make('rank_title'),
            ImportColumn::make('doctoral_title'),
            ImportColumn::make('acad_title_1'),
            ImportColumn::make('acad_title_2'),
            ImportColumn::make('title_by_the_king'),
            ImportColumn::make('citizen_id'),
            ImportColumn::make('birth_date'),
            ImportColumn::make('marital_status'),
            ImportColumn::make('personnel_type'),
            ImportColumn::make('personnel_status'),
            ImportColumn::make('personnel_subgroup'),
            ImportColumn::make('position_name'),
            ImportColumn::make('position_number'),
            ImportColumn::make('start_date'),
            ImportColumn::make('structure_level1_name'),
            ImportColumn::make('structure_level2_name'),
            ImportColumn::make('structure_level3_name'),
            ImportColumn::make('structure_level4_name'),
        ];
    }

    public function resolveRecord(): Personnel
    {
        return Personnel::firstOrNew([
            'personnel_id' => $this->data['personnel_id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
