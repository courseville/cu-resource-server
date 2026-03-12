<?php

namespace App\Filament\Resources\ContractPersonnels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class ContractPersonnelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        Select::make('personnel_id')
                            ->relationship('personnel', 'personnel_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('contract_id')
                            ->label('Contract ID')
                            ->maxLength(255)
                            ->nullable(),
                        TextInput::make('position')
                            ->maxLength(255)
                            ->nullable(),
                    ])->columns(3),

                Section::make('Contract Periods')
                    ->schema([
                        DatePicker::make('start_date')
                            ->nullable(),
                        DatePicker::make('end_date')
                            ->nullable(),
                        TextInput::make('salary')
                            ->numeric()
                            ->nullable(),
                    ])->columns(3),
            ]);
    }
}
