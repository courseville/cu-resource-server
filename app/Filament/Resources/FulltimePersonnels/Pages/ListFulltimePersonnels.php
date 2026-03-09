<?php

namespace App\Filament\Resources\FulltimePersonnels\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\FulltimePersonnels\FulltimePersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFulltimePersonnels extends ListRecords
{
    protected static string $resource = FulltimePersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
