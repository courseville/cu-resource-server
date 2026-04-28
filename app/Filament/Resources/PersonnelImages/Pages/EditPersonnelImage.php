<?php

namespace App\Filament\Resources\PersonnelImages\Pages;

use App\Filament\Resources\PersonnelImages\PersonnelImageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelImage extends EditRecord
{
    protected static string $resource = PersonnelImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
