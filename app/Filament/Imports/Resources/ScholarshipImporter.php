<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Scholarship;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ScholarshipImporter extends Importer
{
    protected static ?string $model = Scholarship::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('scholarship_name')
                ->rules(['max:255']),
            ImportColumn::make('name_en'),
            ImportColumn::make('job_code'),
            ImportColumn::make('fcode'),
            ImportColumn::make('description'),
            ImportColumn::make('file'),
            ImportColumn::make('file_description'),
            ImportColumn::make('academic_year')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('update_by'),
            ImportColumn::make('isactive')
                ->boolean(),
            ImportColumn::make('require_doc')
                ->boolean(),
            ImportColumn::make('require_app1')
                ->boolean(),
            ImportColumn::make('require_app2')
                ->boolean(),
            ImportColumn::make('can_assign')
                ->boolean(),
        ];
    }

    public function resolveRecord(): Scholarship
    {
        return Scholarship::firstOrNew([
            'job_code' => $this->data['job_code'],
            'academic_year' => $this->data['academic_year'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your scholarship import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
