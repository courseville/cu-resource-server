<?php

namespace App\Filament\Resources\TransformerMappings\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\TransformerMappings\TransformerMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransformerMappings extends ListRecords
{
    protected static string $resource = TransformerMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
