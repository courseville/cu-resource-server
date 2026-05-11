<?php

namespace App\Filament\Imports;

use App\Models\Resources\PersonnelAction;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelActionImporter extends Importer
{
    protected static ?string $model = PersonnelAction::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->rules(['max:255']),
            ImportColumn::make('begin_date')
                ->rules(['max:255']),
            ImportColumn::make('end_date')
                ->rules(['max:255']),
            ImportColumn::make('status_id')
                ->rules(['max:255']),
            ImportColumn::make('status_name')
                ->rules(['max:255']),
            ImportColumn::make('action_id')
                ->rules(['max:255']),
            ImportColumn::make('action_name')
                ->rules(['max:255']),
            ImportColumn::make('reason_id')
                ->rules(['max:255']),
            ImportColumn::make('reason_name')
                ->rules(['max:255']),
            ImportColumn::make('modify_user')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): PersonnelAction
    {
        return new PersonnelAction;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel action import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
