<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Company Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Company Name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('address')
                            ->label('Address')
                            ->columnSpanFull(),
                        TextInput::make('admin_name')
                            ->label('Admin Name')
                            ->maxLength(255),
                        TextInput::make('admin_title')
                            ->label('Admin Title')
                            ->maxLength(255),
                        TextInput::make('tel')
                            ->label('Telephone')
                            ->tel()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
