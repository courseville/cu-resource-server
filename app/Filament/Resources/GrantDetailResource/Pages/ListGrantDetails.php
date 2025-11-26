<?php

namespace App\Filament\Resources\GrantDetailResource\Pages;

use App\Filament\Resources\GrantDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGrantDetails extends ListRecords
{
    protected static string $resource = GrantDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
