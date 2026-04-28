<?php

namespace App\Filament\Imports;

use App\Models\Resources\PersonnelProfile;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelProfileImporter extends Importer
{
    protected static ?string $model = PersonnelProfile::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->rules(['max:255']),
            ImportColumn::make('begin_date')
                ->rules(['max:255']),
            ImportColumn::make('end_date')
                ->rules(['max:255']),
            ImportColumn::make('title_id')
                ->rules(['max:255']),
            ImportColumn::make('title_th')
                ->rules(['max:255']),
            ImportColumn::make('name_th')
                ->rules(['max:255']),
            ImportColumn::make('surname_th')
                ->rules(['max:255']),
            ImportColumn::make('gender')
                ->rules(['max:255']),
            ImportColumn::make('birth_date')
                ->rules(['max:255']),
            ImportColumn::make('rank_title')
                ->rules(['max:255']),
            ImportColumn::make('doctoral_title')
                ->rules(['max:255']),
            ImportColumn::make('acad_title_1')
                ->rules(['max:255']),
            ImportColumn::make('acad_title_2')
                ->rules(['max:255']),
            ImportColumn::make('title_by_the_king')
                ->rules(['max:255']),
            ImportColumn::make('nation')
                ->rules(['max:255']),
            ImportColumn::make('marrital_status')
                ->rules(['max:255']),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('title_en')
                ->rules(['max:255']),
            ImportColumn::make('name_en')
                ->rules(['max:255']),
            ImportColumn::make('surname_en')
                ->rules(['max:255']),
            ImportColumn::make('citizen_id')
                ->rules(['max:255']),
            ImportColumn::make('passport_number')
                ->rules(['max:255']),
            ImportColumn::make('office_phonenumber')
                ->rules(['max:255']),
            ImportColumn::make('full_title')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): PersonnelProfile
    {
        return new PersonnelProfile();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel profile import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
