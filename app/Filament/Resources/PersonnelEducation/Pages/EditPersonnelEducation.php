<?php

namespace App\Filament\Resources\PersonnelEducation\Pages;

use App\Filament\Resources\PersonnelEducation\PersonnelEducationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelEducation extends EditRecord
{
    protected static string $resource = PersonnelEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
