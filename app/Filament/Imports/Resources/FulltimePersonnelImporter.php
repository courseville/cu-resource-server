<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\FulltimePersonnel;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class FulltimePersonnelImporter extends Importer
{
    protected static ?string $model = FulltimePersonnel::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('full_time_id')
                ->rules(['max:255']),
            ImportColumn::make('university')
                ->rules(['max:255']),
            ImportColumn::make('degree')
                ->rules(['max:255']),
            ImportColumn::make('education_level')
                ->rules(['max:255']),
            ImportColumn::make('date_of_appointment')
                ->rules(['datetime']),
            ImportColumn::make('asst_prof_date')
                ->rules(['datetime']),
            ImportColumn::make('prof_date')
                ->rules(['datetime']),
            ImportColumn::make('assoc_prof_date')
                ->rules(['datetime']),
            ImportColumn::make('birth_date')
                ->rules(['datetime']),
            ImportColumn::make('age')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('personnel_status_changing_date')
                ->rules(['datetime']),
            ImportColumn::make('salary_band')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('teacher_date')
                ->rules(['datetime']),
            ImportColumn::make('job_type')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): FulltimePersonnel
    {
        return new FulltimePersonnel;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your fulltime personnel import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
