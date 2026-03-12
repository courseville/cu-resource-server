<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\StructureProfile;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class StructureProfileImporter extends Importer
{
    protected static ?string $model = StructureProfile::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('structureLevel1')
                ->relationship(),
            ImportColumn::make('structureLevel2')
                ->relationship(),
            ImportColumn::make('structureLevel3')
                ->relationship(),
            ImportColumn::make('structureLevel4')
                ->relationship(),
        ];
    }

    public function resolveRecord(): StructureProfile
    {
        return new StructureProfile();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your structure profile import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
