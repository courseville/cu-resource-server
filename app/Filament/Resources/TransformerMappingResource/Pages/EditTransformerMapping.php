<?php

namespace App\Filament\Resources\TransformerMappingResource\Pages;

use App\Filament\Resources\TransformerMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransformerMapping extends EditRecord
{
    protected static string $resource = TransformerMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
