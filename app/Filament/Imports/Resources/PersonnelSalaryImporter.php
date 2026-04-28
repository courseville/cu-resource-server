<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\PersonnelSalary;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelSalaryImporter extends Importer
{
    protected static ?string $model = PersonnelSalary::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('amount')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('date')
                ->rules(['datetime']),
        ];
    }

    public function resolveRecord(): PersonnelSalary
    {
        return new PersonnelSalary;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel salary import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
