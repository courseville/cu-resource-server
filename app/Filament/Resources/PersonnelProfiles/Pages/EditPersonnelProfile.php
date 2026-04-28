<?php

namespace App\Filament\Resources\PersonnelProfiles\Pages;

use App\Filament\Resources\PersonnelProfiles\PersonnelProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelProfile extends EditRecord
{
    protected static string $resource = PersonnelProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
