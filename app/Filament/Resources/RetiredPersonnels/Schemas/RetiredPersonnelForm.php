<?php

namespace App\Filament\Resources\RetiredPersonnels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class RetiredPersonnelForm
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
                        TextInput::make('retired_id')
                            ->label('Retired ID')
                            ->maxLength(255)
                            ->nullable(),
                        DatePicker::make('retirement_date')
                            ->nullable(),
                    ])->columns(3),

                Section::make('Retirement Details')
                    ->schema([
                        TextInput::make('last_position')
                            ->maxLength(255)
                            ->nullable(),
                        TextInput::make('retirement_type')
                            ->maxLength(255)
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
