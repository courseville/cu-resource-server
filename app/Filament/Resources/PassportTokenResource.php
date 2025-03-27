<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassportTokenResource\Pages;
use Filament\Resources\Resource;
use Filament\Tables;
use Laravel\Passport\Token;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;

class PassportTokenResource extends Resource
{
    protected static ?string $model = Token::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('client.name')->label('Client'),
            TextColumn::make('user_id')->label('User ID'),
            TextColumn::make('revoked')
                ->badge()
                ->color(fn($state) => $state ? 'danger' : 'success')
                ->formatStateUsing(fn($state) => $state ? 'Revoked' : 'Active'),
        ])
            ->filters([])
            ->actions([DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPassportTokens::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // Disable the Create button
    }
}

