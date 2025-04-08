<?php

namespace App\Filament\Resources\TestProfileResource\Pages;

use App\Filament\Resources\TestProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestProfiles extends ListRecords
{
    protected static string $resource = TestProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
