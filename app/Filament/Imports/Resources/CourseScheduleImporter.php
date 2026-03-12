<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\CourseSchedule;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class CourseScheduleImporter extends Importer
{
    protected static ?string $model = CourseSchedule::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('year')
                ->requiredMapping(),
            ImportColumn::make('semester')
                ->requiredMapping(),
            ImportColumn::make('course_code')
                ->requiredMapping(),
            ImportColumn::make('course_name'),
            ImportColumn::make('section')
                ->requiredMapping(),
            ImportColumn::make('row_seq'),
            ImportColumn::make('teach_type'),
            ImportColumn::make('daycode'),
            ImportColumn::make('teach_time_from'),
            ImportColumn::make('teach_time_to'),
            ImportColumn::make('faccode'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?CourseSchedule
    {
        return CourseSchedule::firstOrNew([
            'year' => $this->data['year'],
            'semester' => $this->data['semester'],
            'course_code' => $this->data['course_code'],
            'section' => $this->data['section'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your course schedule import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
