<?php

namespace App\Filament\Resources\DataSources\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class DataSourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->url()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
                Forms\Components\DateTimePicker::make('last_synced_at')
                    ->disabled(),
            ]);
    }
}
