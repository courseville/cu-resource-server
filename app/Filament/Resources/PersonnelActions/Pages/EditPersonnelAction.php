<?php

namespace App\Filament\Resources\PersonnelActions\Pages;

use App\Filament\Resources\PersonnelActions\PersonnelActionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelAction extends EditRecord
{
    protected static string $resource = PersonnelActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
