<?php

namespace App\Filament\Resources\TransformerMappings\Pages;

use App\Filament\Resources\TransformerMappings\TransformerMappingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransformerMapping extends EditRecord
{
    protected static string $resource = TransformerMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
