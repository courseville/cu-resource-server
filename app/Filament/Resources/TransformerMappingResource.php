<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransformerMappingResource\Pages;
use App\Models\TransformerMapping;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class TransformerMappingResource extends Resource
{
    protected static ?string $model = TransformerMapping::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('source')
                    ->required()
                    ->maxLength(255),
                TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                TextInput::make('field')
                    ->required()
                    ->maxLength(255),
                TextInput::make('mapping')
                    ->required()
                    ->maxLength(255),
                Textarea::make('formatting')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('source')->sortable()->searchable(),
                TextColumn::make('model')->sortable()->searchable(),
                TextColumn::make('field')->sortable()->searchable(),
                TextColumn::make('mapping')->sortable()->searchable(),
                TextColumn::make('formatting')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransformerMappings::route('/'),
            'create' => Pages\CreateTransformerMapping::route('/create'),
            'edit' => Pages\EditTransformerMapping::route('/{record}/edit'),
        ];
    }
}
