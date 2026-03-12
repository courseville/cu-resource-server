<?php

namespace App\Filament\Imports;

use App\Models\TransformerMapping;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class TransformerMappingImporter extends Importer
{
    protected static ?string $model = TransformerMapping::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('data_source_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('model')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('field')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('mapping')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('formatting'),
        ];
    }

    public function resolveRecord(): TransformerMapping
    {
        return new TransformerMapping();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your transformer mapping import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
