<?php

namespace App\Filament\Resources\PersonnelContractDetails\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PersonnelContractDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('personnel_id'),
                TextInput::make('begin_date'),
                TextInput::make('end_date'),
                TextInput::make('contract_type_id'),
                TextInput::make('contract_type_name'),
                TextInput::make('probation'),
                TextInput::make('probation_unit'),
                TextInput::make('contract_end_date'),
                TextInput::make('disemploy_employer'),
                TextInput::make('disemploy_employee'),
            ]);
    }
}
