<?php

namespace App\Filament\Resources\PersonnelContractInfos\Pages;

use App\Filament\Resources\PersonnelContractInfos\PersonnelContractInfoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelContractInfo extends EditRecord
{
    protected static string $resource = PersonnelContractInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
