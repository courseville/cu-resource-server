<?php

namespace App\Filament\Resources\TestProfileResource\Pages;

use App\Filament\Resources\TestProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestProfile extends EditRecord
{
    protected static string $resource = TestProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
