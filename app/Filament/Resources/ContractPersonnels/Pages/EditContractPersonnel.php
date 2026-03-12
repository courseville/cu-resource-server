<?php

namespace App\Filament\Resources\ContractPersonnels\Pages;

use App\Filament\Resources\ContractPersonnels\ContractPersonnelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContractPersonnel extends EditRecord
{
    protected static string $resource = ContractPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
