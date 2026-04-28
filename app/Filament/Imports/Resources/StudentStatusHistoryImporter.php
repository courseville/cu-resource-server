<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\StudentStatusHistory;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StudentStatusHistoryImporter extends Importer
{
    protected static ?string $model = StudentStatusHistory::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_code')
                ->requiredMapping(),
            ImportColumn::make('name_thai'),
            ImportColumn::make('name_english'),
            ImportColumn::make('status'),
            ImportColumn::make('effect_date'),
            ImportColumn::make('from_acad_year'),
            ImportColumn::make('from_semester'),
            ImportColumn::make('to_acad_year'),
            ImportColumn::make('to_semester'),
            ImportColumn::make('instruction_no'),
            ImportColumn::make('announcement'),
            ImportColumn::make('faccode'),
            ImportColumn::make('depcode'),
            ImportColumn::make('majorcode'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?StudentStatusHistory
    {
        return StudentStatusHistory::firstOrNew([
            'student_code' => $this->data['student_code'],
            'from_acad_year' => $this->data['from_acad_year'],
            'from_semester' => $this->data['from_semester'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student status history import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
