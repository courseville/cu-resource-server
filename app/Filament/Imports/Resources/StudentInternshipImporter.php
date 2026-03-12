<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\StudentInternship;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StudentInternshipImporter extends Importer
{
    protected static ?string $model = StudentInternship::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_code')
                ->requiredMapping(),
            ImportColumn::make('acad_year'),
            ImportColumn::make('semester'),
            ImportColumn::make('company_name')
                ->requiredMapping(),
            ImportColumn::make('start_date'),
            ImportColumn::make('end_date'),
            ImportColumn::make('faccode'),
            ImportColumn::make('depcode'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?StudentInternship
    {
        return StudentInternship::firstOrNew([
            'student_code' => $this->data['student_code'],
            'company_name' => $this->data['company_name'],
            'start_date' => $this->data['start_date'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student internship import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
