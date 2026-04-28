<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\ContractPersonnel;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ContractPersonnelImporter extends Importer
{
    protected static ?string $model = ContractPersonnel::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('contract_id')
                ->rules(['max:255']),
            ImportColumn::make('start_date')
                ->rules(['datetime']),
            ImportColumn::make('end_date')
                ->rules(['datetime']),
            ImportColumn::make('detail'),
        ];
    }

    public function resolveRecord(): ContractPersonnel
    {
        return new ContractPersonnel;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your contract personnel import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
