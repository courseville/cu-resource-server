<?php

namespace App\Filament\Resources\DataConflicts\Pages;

use App\Filament\Resources\DataConflictResource;
use Filament\Resources\Pages\ListRecords;

class ListDataConflicts extends ListRecords
{
    protected static string $resource = DataConflictResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No create action
        ];
    }
}
