<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\StudentCurriculum;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StudentCurriculumImporter extends Importer
{
    protected static ?string $model = StudentCurriculum::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('year')
                ->requiredMapping(),
            ImportColumn::make('semester')
                ->requiredMapping(),
            ImportColumn::make('student_code')
                ->requiredMapping(),
            ImportColumn::make('name_thai'),
            ImportColumn::make('name_english'),
            ImportColumn::make('course_code')
                ->requiredMapping(),
            ImportColumn::make('course_name'),
            ImportColumn::make('section'),
            ImportColumn::make('grade'),
            ImportColumn::make('credit_tot'),
            ImportColumn::make('faccode'),
            ImportColumn::make('depcode'),
            ImportColumn::make('majorcode'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?StudentCurriculum
    {
        return StudentCurriculum::firstOrNew([
            'year' => $this->data['year'],
            'semester' => $this->data['semester'],
            'student_code' => $this->data['student_code'],
            'course_code' => $this->data['course_code'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student curriculum import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
