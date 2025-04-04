<?php

namespace App\Filament\Resources\TransformerMappingResource\Pages;

use App\Filament\Resources\TransformerMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransformerMappings extends ListRecords
{
    protected static string $resource = TransformerMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
