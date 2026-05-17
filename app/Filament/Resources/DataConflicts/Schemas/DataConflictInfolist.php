<?php

namespace App\Filament\Resources\DataConflicts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DataConflictInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Conflict Overview')
                    ->schema([
                        TextEntry::make('model_class')
                            ->label('Model'),
                        TextEntry::make('model_pk_value')
                            ->label('Primary Key'),
                        TextEntry::make('dataSource.name')
                            ->label('Data Source'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'pending' => 'warning',
                                'resolved_incoming' => 'success',
                                'resolved_current' => 'gray',
                                default => 'gray',
                            }),
                    ])->columns(2),

                Section::make('Data Comparison')
                    ->schema([
                        TextEntry::make('current_data')
                            ->label('Current Data')
                            ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
                            ->columnSpan(1),
                        TextEntry::make('incoming_data')
                            ->label('Incoming Data')
                            ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
                            ->columnSpan(1),
                    ])->columns(2),
            ]);
    }
}
