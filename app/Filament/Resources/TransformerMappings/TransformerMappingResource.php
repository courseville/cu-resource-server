<?php

namespace App\Filament\Resources\TransformerMappings;

use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\TransformerMappings\Pages\ListTransformerMappings;
use App\Filament\Resources\TransformerMappings\Pages\CreateTransformerMapping;
use App\Filament\Resources\TransformerMappings\Pages\EditTransformerMapping;
use App\Filament\Resources\TransformerMappingResource\Pages;
use App\Models\TransformerMapping;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class TransformerMappingResource extends Resource
{
    protected static ?string $model = TransformerMapping::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('data_source_id')
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('data_source_id')->sortable()->searchable(),
                TextColumn::make('model')->sortable()->searchable(),
                TextColumn::make('field')->sortable()->searchable(),
                TextColumn::make('mapping')->sortable()->searchable(),
                TextColumn::make('formatting')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransformerMappings::route('/'),
            'create' => CreateTransformerMapping::route('/create'),
            'edit' => EditTransformerMapping::route('/{record}/edit'),
        ];
    }
}
