<?php

namespace App\Filament\Resources\Faculties\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FacultyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Faculty Information')
                    ->schema([
                        TextInput::make('faccode')
                            ->label('Faculty Code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('name_th')
                            ->label('Name (TH)')
                            ->maxLength(255),
                        TextInput::make('name_en')
                            ->label('Name (EN)')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
