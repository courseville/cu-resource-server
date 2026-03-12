<?php

namespace App\Filament\Imports\Resources;

use App\Models\Resources\ProgramCommittee;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ProgramCommitteeImporter extends Importer
{
    protected static ?string $model = ProgramCommittee::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('program_no')
                ->requiredMapping(),
            ImportColumn::make('active_year')
                ->requiredMapping(),
            ImportColumn::make('committee_tag'),
            ImportColumn::make('effective_date'),
            ImportColumn::make('personal_id')
                ->requiredMapping(),
            ImportColumn::make('data_id'),
        ];
    }

    public function resolveRecord(): ?ProgramCommittee
    {
        return ProgramCommittee::firstOrNew([
            'program_no' => $this->data['program_no'],
            'personal_id' => $this->data['personal_id'],
            'active_year' => $this->data['active_year'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your program committee import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
