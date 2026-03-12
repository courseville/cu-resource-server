<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\StudentAdmission;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StudentAdmissionImporter extends Importer
{
    protected static ?string $model = StudentAdmission::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_code')
                ->requiredMapping(),
            ImportColumn::make('name_thai'),
            ImportColumn::make('name_english'),
            ImportColumn::make('faccode'),
            ImportColumn::make('depcode'),
            ImportColumn::make('majorcode'),
            ImportColumn::make('admission_type'),
            ImportColumn::make('apply_year'),
            ImportColumn::make('apply_semester'),
            ImportColumn::make('apply_date'),
            ImportColumn::make('apply_status'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?StudentAdmission
    {
        return StudentAdmission::firstOrNew([
            'student_code' => $this->data['student_code'],
            'apply_year' => $this->data['apply_year'],
            'apply_semester' => $this->data['apply_semester'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student admission import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
