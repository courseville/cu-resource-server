<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\CourseInstructor;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class CourseInstructorImporter extends Importer
{
    protected static ?string $model = CourseInstructor::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('acad_year')
                ->requiredMapping(),
            ImportColumn::make('semester')
                ->requiredMapping(),
            ImportColumn::make('course_code')
                ->requiredMapping(),
            ImportColumn::make('row_seq'),
            ImportColumn::make('section')
                ->requiredMapping(),
            ImportColumn::make('instructor_no')
                ->requiredMapping(),
            ImportColumn::make('instructor_name'),
            ImportColumn::make('instructor_name_en'),
            ImportColumn::make('faccode'),
            ImportColumn::make('depcode'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?CourseInstructor
    {
        return CourseInstructor::firstOrNew([
            'acad_year' => $this->data['acad_year'],
            'semester' => $this->data['semester'],
            'course_code' => $this->data['course_code'],
            'section' => $this->data['section'],
            'instructor_no' => $this->data['instructor_no'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your course instructor import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
