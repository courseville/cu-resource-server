<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Scholarship;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ScholarshipImporter extends Importer
{
    protected static ?string $model = Scholarship::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('scholarship_name')
                ->rules(['max:255']),
            ImportColumn::make('description'),
            ImportColumn::make('file'),
            ImportColumn::make('file_description'),
            ImportColumn::make('academic_year')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): Scholarship
    {
        return new Scholarship();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your scholarship import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
