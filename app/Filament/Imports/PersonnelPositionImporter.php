<?php

namespace App\Filament\Imports;

use App\Models\Resources\PersonnelPosition;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelPositionImporter extends Importer
{
    protected static ?string $model = PersonnelPosition::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->rules(['max:255']),
            ImportColumn::make('begin_date')
                ->rules(['max:255']),
            ImportColumn::make('end_date')
                ->rules(['max:255']),
            ImportColumn::make('positiontype_id')
                ->rules(['max:255']),
            ImportColumn::make('positiontype_name')
                ->rules(['max:255']),
            ImportColumn::make('positiontype_text')
                ->rules(['max:255']),
            ImportColumn::make('fieldstudy')
                ->rules(['max:255']),
            ImportColumn::make('subdiscipline_1')
                ->rules(['max:255']),
            ImportColumn::make('subdiscipline_2')
                ->rules(['max:255']),
            ImportColumn::make('subdiscipline_3')
                ->rules(['max:255']),
            ImportColumn::make('subdiscipline_4')
                ->rules(['max:255']),
            ImportColumn::make('subdiscipline_5')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): PersonnelPosition
    {
        return new PersonnelPosition();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel position import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
