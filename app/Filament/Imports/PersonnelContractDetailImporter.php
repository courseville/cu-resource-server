<?php

namespace App\Filament\Imports;

use App\Models\Resources\PersonnelContractDetail;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelContractDetailImporter extends Importer
{
    protected static ?string $model = PersonnelContractDetail::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->rules(['max:255']),
            ImportColumn::make('begin_date')
                ->rules(['max:255']),
            ImportColumn::make('end_date')
                ->rules(['max:255']),
            ImportColumn::make('contract_type_id')
                ->rules(['max:255']),
            ImportColumn::make('contract_type_name')
                ->rules(['max:255']),
            ImportColumn::make('probation')
                ->rules(['max:255']),
            ImportColumn::make('probation_unit')
                ->rules(['max:255']),
            ImportColumn::make('contract_end_date')
                ->rules(['max:255']),
            ImportColumn::make('disemploy_employer')
                ->rules(['max:255']),
            ImportColumn::make('disemploy_employee')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): PersonnelContractDetail
    {
        return new PersonnelContractDetail();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel contract detail import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
