<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassportClientResource\Pages;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms;
use Laravel\Passport\Client;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Support\Str;

class PassportClientResource extends Resource
{
    protected static ?string $model = Client::class;
    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('redirect')->required(),
            Toggle::make('personal_access_client'),
            Toggle::make('password_client'),
            Toggle::make('revoked'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->sortable(),
            TextColumn::make('redirect')->limit(30),
            TextColumn::make('personal_access_client')
                ->badge()
                ->color(fn($state) => $state ? 'success' : 'danger')
                ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),
            TextColumn::make('password_client')
                ->badge()
                ->color(fn($state) => $state ? 'success' : 'danger')
                ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),

            TextColumn::make('revoked')
                ->badge()
                ->color(fn($state) => $state ? 'danger' : 'success')
                ->formatStateUsing(fn($state) => $state ? 'Revoked' : 'Active'),

            TextColumn::make('secret')->limit(40)->label('Client Secret'),
        ])
            ->filters([])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->recordUrl(null);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPassportClients::route('/'),
            'create' => Pages\CreatePassportClient::route('/create'),
            'edit' => Pages\EditPassportClient::route('/{record}/edit'),
        ];
    }
}

