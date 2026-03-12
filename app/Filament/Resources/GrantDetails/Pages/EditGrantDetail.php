<?php

namespace App\Filament\Resources\GrantDetails\Pages;

use App\Filament\Resources\GrantDetails\GrantDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGrantDetail extends EditRecord
{
    protected static string $resource = GrantDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
