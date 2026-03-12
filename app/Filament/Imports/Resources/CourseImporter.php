<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Course;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class CourseImporter extends Importer
{
    protected static ?string $model = Course::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('course_id')
                ->requiredMapping(),
            ImportColumn::make('course_no'),
            ImportColumn::make('program_id'),
            ImportColumn::make('revision_year'),
            ImportColumn::make('name_th'),
            ImportColumn::make('name_en'),
            ImportColumn::make('name_abbr'),
            ImportColumn::make('credits')
                ->numeric(),
            ImportColumn::make('l_credit')
                ->numeric(),
            ImportColumn::make('nl_credit')
                ->numeric(),
            ImportColumn::make('l_hour')
                ->numeric(),
            ImportColumn::make('nl_hour')
                ->numeric(),
            ImportColumn::make('s_hour')
                ->numeric(),
            ImportColumn::make('description_th'),
            ImportColumn::make('description_en'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?Course
    {
        return Course::firstOrNew([
            'course_id' => $this->data['course_id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your course import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
