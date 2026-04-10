<?php

namespace App\Filament\Imports;

use App\Models\Resources\StudentGrade;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class StudentGradeImporter extends Importer
{
    protected static ?string $model = StudentGrade::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_code')
                ->rules(['max:255']),
            ImportColumn::make('year')
                ->rules(['max:255']),
            ImportColumn::make('semester')
                ->rules(['max:255']),
            ImportColumn::make('course_code')
                ->rules(['max:255']),
            ImportColumn::make('total_credit')
                ->rules(['max:255']),
            ImportColumn::make('grade')
                ->rules(['max:255']),
            ImportColumn::make('last_update')
                ->rules(['max:255']),
            ImportColumn::make('faccode')
                ->rules(['max:255']),
            ImportColumn::make('depcode')
                ->rules(['max:255']),
            ImportColumn::make('majorcode')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): StudentGrade
    {
        return new StudentGrade();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student grade import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
