<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Curriculum;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class CurriculumImporter extends Importer
{
    protected static ?string $model = Curriculum::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('course_code_no')
                ->requiredMapping(),
            ImportColumn::make('major_code')
                ->requiredMapping(),
            ImportColumn::make('degree'),
            ImportColumn::make('major'),
            ImportColumn::make('no_year_study'),
            ImportColumn::make('plan1'),
            ImportColumn::make('language1'),
            ImportColumn::make('program_system'),
            ImportColumn::make('calendar'),
            ImportColumn::make('begin_year'),
            ImportColumn::make('begin_semester'),
            ImportColumn::make('faccode'),
            ImportColumn::make('depcode'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?Curriculum
    {
        return Curriculum::firstOrNew([
            'course_code_no' => $this->data['course_code_no'],
            'major_code' => $this->data['major_code'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your curriculum import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
