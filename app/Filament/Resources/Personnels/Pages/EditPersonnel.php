<?php

namespace App\Filament\Resources\Personnels\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Personnels\PersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonnel extends EditRecord
{
    protected static string $resource = PersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
