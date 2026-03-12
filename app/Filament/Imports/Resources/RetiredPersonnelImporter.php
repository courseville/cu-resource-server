<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\RetiredPersonnel;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class RetiredPersonnelImporter extends Importer
{
    protected static ?string $model = RetiredPersonnel::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('retired_id')
                ->rules(['max:255']),
            ImportColumn::make('date')
                ->rules(['datetime']),
            ImportColumn::make('type')
                ->rules(['max:255']),
            ImportColumn::make('citizen_id')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): RetiredPersonnel
    {
        return new RetiredPersonnel();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your retired personnel import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
