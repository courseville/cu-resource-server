<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\StudentGraduation;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StudentGraduationImporter extends Importer
{
    protected static ?string $model = StudentGraduation::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_code')
                ->requiredMapping(),
            ImportColumn::make('acad_year'),
            ImportColumn::make('semester'),
            ImportColumn::make('name_thai'),
            ImportColumn::make('name_english'),
            ImportColumn::make('major_thai'),
            ImportColumn::make('major_english'),
            ImportColumn::make('degree_thai'),
            ImportColumn::make('degree_english'),
            ImportColumn::make('graduate_date'),
            ImportColumn::make('concil_date'),
            ImportColumn::make('distinction'),
            ImportColumn::make('faccode'),
            ImportColumn::make('depcode'),
            ImportColumn::make('majorcode'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?StudentGraduation
    {
        return StudentGraduation::firstOrNew([
            'student_code' => $this->data['student_code'],
            'graduate_date' => $this->data['graduate_date'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student graduation import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
