<?php

namespace App\Filament\Resources\DataConflicts\Pages;

use App\Filament\Resources\DataConflictResource;
use Filament\Resources\Pages\ViewRecord;

class ViewDataConflict extends ViewRecord
{
    protected static string $resource = DataConflictResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No edit/delete
        ];
    }
}
