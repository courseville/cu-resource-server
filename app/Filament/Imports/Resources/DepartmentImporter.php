<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Department;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class DepartmentImporter extends Importer
{
    protected static ?string $model = Department::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('depcode')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('name_th')
                ->rules(['max:255']),
            ImportColumn::make('name_en')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Department
    {
        return Department::firstOrNew([
            'depcode' => $this->data['depcode'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your department import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
