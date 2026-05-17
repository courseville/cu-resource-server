<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Faculty;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class FacultyImporter extends Importer
{
    protected static ?string $model = Faculty::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('faccode')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('name_th')
                ->rules(['max:255']),
            ImportColumn::make('name_en')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Faculty
    {
        return Faculty::firstOrNew([
            'faccode' => $this->data['faccode'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your faculty import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
