<?php

namespace App\Filament\Resources\RetiredPersonnels\Pages;

use App\Filament\Resources\RetiredPersonnels\RetiredPersonnelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRetiredPersonnel extends EditRecord
{
    protected static string $resource = RetiredPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
