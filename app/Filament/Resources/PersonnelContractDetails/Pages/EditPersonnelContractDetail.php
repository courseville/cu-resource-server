<?php

namespace App\Filament\Resources\PersonnelContractDetails\Pages;

use App\Filament\Resources\PersonnelContractDetails\PersonnelContractDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelContractDetail extends EditRecord
{
    protected static string $resource = PersonnelContractDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
