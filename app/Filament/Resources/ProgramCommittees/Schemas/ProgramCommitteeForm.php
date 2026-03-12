<?php

namespace App\Filament\Resources\ProgramCommittees\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;

class ProgramCommitteeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Committee Identification')
                    ->schema([
                        TextInput::make('program_no')
                            ->label('Program No.')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('active_year')
                            ->label('Active Year')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Committee Details')
                    ->schema([
                        TextInput::make('committee_tag')
                            ->label('Committee Tag')
                            ->maxLength(255),
                        DatePicker::make('effective_date')
                            ->label('Effective Date'),
                        TextInput::make('personal_id')
                            ->label('Personal ID')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
