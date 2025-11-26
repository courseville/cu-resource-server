<?php

namespace App\Filament\Resources\ContractPersonnelResource\Pages;

use App\Filament\Resources\ContractPersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContractPersonnel extends EditRecord
{
    protected static string $resource = ContractPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
