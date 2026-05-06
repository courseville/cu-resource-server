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
                Forms\Components\Select::make('type')
                    ->options([
                        'file' => 'File',
                        'mysql' => 'MySQL',
                    ])
                    ->required()
                    ->default('file'),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255)
                    ->hint('For MySQL: connection:table[:order_by_column]'),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
                Forms\Components\DateTimePicker::make('last_synced_at')
                    ->disabled(),
            ]);
    }
}
