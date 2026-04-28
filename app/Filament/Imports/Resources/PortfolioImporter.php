<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\Portfolio;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PortfolioImporter extends Importer
{
    protected static ?string $model = Portfolio::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('application_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('signature'),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('phone_number')
                ->rules(['max:255']),
            ImportColumn::make('picture'),
            ImportColumn::make('intro_video'),
            ImportColumn::make('work'),
        ];
    }

    public function resolveRecord(): Portfolio
    {
        return new Portfolio;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your portfolio import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
