<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\AdmissionApplication;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class AdmissionApplicationImporter extends Importer
{
    protected static ?string $model = AdmissionApplication::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('application_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('school')
                ->rules(['max:255']),
            ImportColumn::make('score')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): AdmissionApplication
    {
        return new AdmissionApplication();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your admission application import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
