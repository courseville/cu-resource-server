<?php

namespace App\Filament\Resources\ContractPersonnels\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\ContractPersonnels\ContractPersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContractPersonnels extends ListRecords
{
    protected static string $resource = ContractPersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
