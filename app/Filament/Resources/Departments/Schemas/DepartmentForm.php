<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Department Information')
                    ->schema([
                        TextInput::make('depcode')
                            ->label('Department Code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('name_th')
                            ->label('Name (Thai)')
                            ->maxLength(255),
                        TextInput::make('name_en')
                            ->label('Name (English)')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
