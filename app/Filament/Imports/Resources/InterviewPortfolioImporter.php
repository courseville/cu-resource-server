<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\InterviewPortfolio;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class InterviewPortfolioImporter extends Importer
{
    protected static ?string $model = InterviewPortfolio::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('application_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('interviewer_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): InterviewPortfolio
    {
        return new InterviewPortfolio();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your interview portfolio import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
