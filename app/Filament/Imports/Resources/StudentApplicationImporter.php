<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\StudentApplication;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class StudentApplicationImporter extends Importer
{
    protected static ?string $model = StudentApplication::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('application_id')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('citizen_id')
                ->rules(['max:255']),
            ImportColumn::make('transcript_title')
                ->rules(['max:255']),
            ImportColumn::make('first_name')
                ->rules(['max:255']),
            ImportColumn::make('last_name')
                ->rules(['max:255']),
            ImportColumn::make('student_type')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): StudentApplication
    {
        return new StudentApplication();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student application import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
