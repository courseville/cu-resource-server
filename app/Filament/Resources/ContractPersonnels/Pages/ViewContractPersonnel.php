<?php

namespace App\Filament\Resources\ContractPersonnels\Pages;

use App\Filament\Resources\ContractPersonnels\ContractPersonnelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContractPersonnel extends ViewRecord
{
    protected static string $resource = ContractPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
