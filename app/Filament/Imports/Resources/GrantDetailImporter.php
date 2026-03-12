<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\GrantDetail;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class GrantDetailImporter extends Importer
{
    protected static ?string $model = GrantDetail::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('type')
                ->rules(['max:255']),
            ImportColumn::make('travel_cost')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('accommodation_cost')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('lump_sum_allowance')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('first_student_id')
                ->rules(['max:255']),
            ImportColumn::make('second_student_id')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): GrantDetail
    {
        return new GrantDetail();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your grant detail import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
