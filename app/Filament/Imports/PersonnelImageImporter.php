<?php

namespace App\Filament\Imports;

use App\Models\Resources\PersonnelImage;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class PersonnelImageImporter extends Importer
{
    protected static ?string $model = PersonnelImage::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('personnel_id')
                ->rules(['max:255']),
            ImportColumn::make('citizen_id')
                ->rules(['max:255']),
            ImportColumn::make('passport_number')
                ->rules(['max:255']),
            ImportColumn::make('image_name')
                ->rules(['max:255']),
            ImportColumn::make('begin_date')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): PersonnelImage
    {
        return new PersonnelImage;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your personnel image import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
