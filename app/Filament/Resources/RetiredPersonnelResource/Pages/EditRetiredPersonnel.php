<?php

namespace App\Filament\Resources\RetiredPersonnelResource\Pages;

use App\Filament\Resources\RetiredPersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRetiredPersonnel extends EditRecord
{
    protected static string $resource = RetiredPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
