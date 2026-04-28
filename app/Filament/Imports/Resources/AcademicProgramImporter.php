<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\AcademicProgram;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AcademicProgramImporter extends Importer
{
    protected static ?string $model = AcademicProgram::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('oaa_program_id')
                ->requiredMapping(),
            ImportColumn::make('ops_no'),
            ImportColumn::make('program_name_th'),
            ImportColumn::make('program_name_en'),
            ImportColumn::make('title_degree_th'),
            ImportColumn::make('title_degree_en'),
            ImportColumn::make('degree_name_th'),
            ImportColumn::make('degree_name_en'),
            ImportColumn::make('faculty_code'),
            ImportColumn::make('level_code'),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?AcademicProgram
    {
        return AcademicProgram::firstOrNew([
            'oaa_program_id' => $this->data['oaa_program_id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your academic program import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
