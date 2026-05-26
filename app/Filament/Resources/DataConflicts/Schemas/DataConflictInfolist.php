<?php

namespace App\Filament\Resources\DataConflicts\Schemas;

use App\Livewire\DataConflictComparisonTable;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Livewire;
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
                        TextEntry::make('resolvedBy.name')
                            ->label('Resolved By')
                            ->visible(fn ($record) => $record && $record->resolved_by !== null),
                        TextEntry::make('resolved_at')
                            ->label('Resolved At')
                            ->dateTime()
                            ->visible(fn ($record) => $record && $record->resolved_at !== null),
                    ])->columns(2)
                    ->columnSpanFull(),

                Section::make('Data Comparison')
                    ->schema([
                        Livewire::make(DataConflictComparisonTable::class)
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ]);
    }
}
