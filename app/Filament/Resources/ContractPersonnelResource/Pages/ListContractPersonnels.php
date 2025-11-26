<?php

namespace App\Filament\Resources\ContractPersonnelResource\Pages;

use App\Filament\Resources\ContractPersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContractPersonnels extends ListRecords
{
    protected static string $resource = ContractPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
