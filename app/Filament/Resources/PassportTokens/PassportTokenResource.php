<?php

namespace App\Filament\Resources\PassportTokens;

use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\PassportTokens\Pages\ListPassportTokens;
use App\Filament\Resources\PassportTokenResource\Pages;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Laravel\Passport\Token;

class PassportTokenResource extends Resource
{
    protected static ?string $model = Token::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shield-check';

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('client.name')->label('Client'),
            TextColumn::make('client_id')->label('Client ID'),
            TextColumn::make('revoked')
                ->badge()
                ->color(fn ($state) => $state ? 'danger' : 'success')
                ->formatStateUsing(fn ($state) => $state ? 'Revoked' : 'Active'),
        ])
            ->filters([])
            ->recordActions([DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPassportTokens::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // Disable the Create button
    }
}
