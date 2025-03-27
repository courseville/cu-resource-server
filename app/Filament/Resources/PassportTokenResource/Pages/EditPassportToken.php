<?php

namespace App\Filament\Resources\PassportTokenResource\Pages;

use App\Filament\Resources\PassportTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPassportToken extends EditRecord
{
    protected static string $resource = PassportTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
