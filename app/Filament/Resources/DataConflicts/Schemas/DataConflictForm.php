<?php

namespace App\Filament\Resources\DataConflicts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DataConflictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Conflict Details')
                    ->schema([
                        TextInput::make('model_class')
                            ->label('Resource')
                            ->formatStateUsing(fn (string $state): string => str(class_basename($state))->headline())
                            ->disabled(),
                        TextInput::make('model_pk_value')
                            ->label('Primary Key Value')
                            ->disabled(),
                        TextInput::make('status')
                            ->disabled(),
                    ])->columns(2),
            ]);
    }
}
