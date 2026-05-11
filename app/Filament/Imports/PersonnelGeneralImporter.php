<?php

namespace App\Filament\Imports;

use App\Models\Resources\PersonnelGeneral;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelGeneralImporter extends Importer
{
    protected static ?string $model = PersonnelGeneral::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->rules(['max:255']),
            ImportColumn::make('begin_date')
                ->rules(['max:255']),
            ImportColumn::make('end_date')
                ->rules(['max:255']),
            ImportColumn::make('status_id')
                ->rules(['max:255']),
            ImportColumn::make('title_th')
                ->rules(['max:255']),
            ImportColumn::make('name_th')
                ->rules(['max:255']),
            ImportColumn::make('surname_th')
                ->rules(['max:255']),
            ImportColumn::make('title_en')
                ->rules(['max:255']),
            ImportColumn::make('name_en')
                ->rules(['max:255']),
            ImportColumn::make('surname_en')
                ->rules(['max:255']),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('nation')
                ->rules(['max:255']),
            ImportColumn::make('citizen_id')
                ->rules(['max:255']),
            ImportColumn::make('passport_number')
                ->rules(['max:255']),
            ImportColumn::make('staff_group')
                ->rules(['max:255']),
            ImportColumn::make('personnel_grp_id')
                ->rules(['max:255']),
            ImportColumn::make('personnel_grp_name')
                ->rules(['max:255']),
            ImportColumn::make('personnel_subgrp_name')
                ->rules(['max:255']),
            ImportColumn::make('position_name')
                ->rules(['max:255']),
            ImportColumn::make('position_number')
                ->rules(['max:255']),
            ImportColumn::make('contract_type_id')
                ->rules(['max:255']),
            ImportColumn::make('contract_type_name')
                ->rules(['max:255']),
            ImportColumn::make('contract_end_date')
                ->rules(['max:255']),
            ImportColumn::make('btrtl')
                ->rules(['max:255']),
            ImportColumn::make('btrtl_text')
                ->rules(['max:255']),
            ImportColumn::make('stell')
                ->rules(['max:255']),
            ImportColumn::make('stell_text')
                ->rules(['max:255']),
            ImportColumn::make('ansvh')
                ->rules(['max:255']),
            ImportColumn::make('ansvh_text')
                ->rules(['max:255']),
            ImportColumn::make('organization_id')
                ->rules(['max:255']),
            ImportColumn::make('organization_name')
                ->rules(['max:255']),
            ImportColumn::make('structure_level1_name')
                ->rules(['max:255']),
            ImportColumn::make('structure_level2_name')
                ->rules(['max:255']),
            ImportColumn::make('structure_level3_name')
                ->rules(['max:255']),
            ImportColumn::make('structure_level4_name')
                ->rules(['max:255']),
            ImportColumn::make('employee_name')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): PersonnelGeneral
    {
        return new PersonnelGeneral;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel general import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
