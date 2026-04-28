<?php

namespace App\Filament\Imports;

use App\Models\Permission;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PermissionImporter extends Importer
{
    protected static ?string $model = Permission::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('action')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('model')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('columns')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): Permission
    {
        return new Permission;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your permission import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
