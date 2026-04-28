<?php

namespace App\Filament\Resources\PassportClients;

use App\Filament\Resources\PassportClients\Pages\CreatePassportClient;
use App\Filament\Resources\PassportClients\Pages\EditPassportClient;
use App\Filament\Resources\PassportClients\Pages\ListPassportClients;
use App\Filament\Resources\PassportClients\RelationManagers\RolesRelationManager;
use App\Models\Client;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PassportClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-key';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('redirect')->required(),
            Toggle::make('personal_access_client'),
            Toggle::make('password_client'),
            Toggle::make('revoked'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->sortable(),
            TextColumn::make('redirect')->limit(30),
            TextColumn::make('personal_access_client')
                ->badge()
                ->color(fn ($state) => $state ? 'success' : 'danger')
                ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
            TextColumn::make('password_client')
                ->badge()
                ->color(fn ($state) => $state ? 'success' : 'danger')
                ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),

            TextColumn::make('revoked')
                ->badge()
                ->color(fn ($state) => $state ? 'danger' : 'success')
                ->formatStateUsing(fn ($state) => $state ? 'Revoked' : 'Active'),

            // TextColumn::make('secret')
            //     ->limit(40),
        ])
            ->filters([])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->recordUrl(null);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPassportClients::route('/'),
            'create' => CreatePassportClient::route('/create'),
            'edit' => EditPassportClient::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // Disable the Create button
    }

    public static function getRelations(): array
    {
        return [
            RolesRelationManager::class,
        ];
    }
}
