<?php

namespace App\Filament\Resources\FulltimePersonnels\Pages;

use App\Filament\Resources\FulltimePersonnels\FulltimePersonnelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFulltimePersonnel extends ViewRecord
{
    protected static string $resource = FulltimePersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
