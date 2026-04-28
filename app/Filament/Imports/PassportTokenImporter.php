<?php

namespace App\Filament\Imports;

use App\Models\PassportToken;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PassportTokenImporter extends Importer
{
    protected static ?string $model = PassportToken::class;

    public static function getColumns(): array
    {
        return [
            //
        ];
    }

    public function resolveRecord(): PassportToken
    {
        return new PassportToken;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your passport token import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
