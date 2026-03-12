<?php

namespace App\Filament\Resources\PassportTokens\Pages;

use App\Filament\Resources\PassportTokens\PassportTokenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPassportToken extends EditRecord
{
    protected static string $resource = PassportTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
