<?php

namespace App\Filament\Imports;

use App\Models\Resources\PersonnelEducation;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelEducationImporter extends Importer
{
    protected static ?string $model = PersonnelEducation::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->rules(['max:255']),
            ImportColumn::make('begin_date')
                ->rules(['max:255']),
            ImportColumn::make('end_date')
                ->rules(['max:255']),
            ImportColumn::make('education_level_id')
                ->rules(['max:255']),
            ImportColumn::make('education_level_name')
                ->rules(['max:255']),
            ImportColumn::make('institution_id')
                ->rules(['max:255']),
            ImportColumn::make('institution_name')
                ->rules(['max:255']),
            ImportColumn::make('major_id')
                ->rules(['max:255']),
            ImportColumn::make('major_name')
                ->rules(['max:255']),
            ImportColumn::make('degree_id')
                ->rules(['max:255']),
            ImportColumn::make('degree_name')
                ->rules(['max:255']),
            ImportColumn::make('nation_id')
                ->rules(['max:255']),
            ImportColumn::make('nation_name_th')
                ->rules(['max:255']),
            ImportColumn::make('distinction_id')
                ->rules(['max:255']),
            ImportColumn::make('distinction_name')
                ->rules(['max:255']),
            ImportColumn::make('highest_education')
                ->rules(['max:255']),
            ImportColumn::make('highest_education_th')
                ->rules(['max:255']),
            ImportColumn::make('employ_education_id')
                ->rules(['max:255']),
            ImportColumn::make('employ_education_name')
                ->rules(['max:255']),
            ImportColumn::make('graduate_date')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): PersonnelEducation
    {
        return PersonnelEducation::firstOrNew([
            'personnel_id' => $this->data['personnel_id'],
            'degree_name' => $this->data['degree_name'],
            'institution_name' => $this->data['institution_name'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel education import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
