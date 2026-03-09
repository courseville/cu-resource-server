<?php

namespace App\Filament\Resources\GrantDetails\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\GrantDetails\GrantDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGrantDetails extends ListRecords
{
    protected static string $resource = GrantDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
