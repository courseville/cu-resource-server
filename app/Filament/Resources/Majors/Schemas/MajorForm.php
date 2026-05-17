<?php

namespace App\Filament\Resources\Majors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MajorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Major Information')
                    ->schema([
                        TextInput::make('majorcode')
                            ->label('Major Code')
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
