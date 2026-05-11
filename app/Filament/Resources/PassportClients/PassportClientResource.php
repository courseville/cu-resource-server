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
use Laravel\Passport\Passport;

class PassportClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-key';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('redirect')
                ->url()
                ->helperText('Required for Authorization Code grant. Leave blank for Client Credentials or Personal Access clients.')
                ->dehydrateStateUsing(fn ($state) => $state ?? ''),
            Toggle::make('personal_access_client')
                ->helperText('Enable to allow this client to issue personal access tokens.'),
            // Toggle::make('password_client')
            //     ->helperText('Enable for the password grant. Leave both toggles off for a Client Credentials client.'),
            Toggle::make('revoked')->columnSpanFull(),
        ]);
    }

    public static function syncPersonalAccessClient(Client $client): void
    {
        $exists = Passport::personalAccessClient()
            ->where('client_id', $client->getKey())
            ->exists();

        if ($client->personal_access_client && ! $exists) {
            $pac = Passport::personalAccessClient();
            $pac->client_id = $client->getKey();
            $pac->save();

            return;
        }

        if (! $client->personal_access_client && $exists) {
            Passport::personalAccessClient()
                ->where('client_id', $client->getKey())
                ->delete();
        }
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('id', 'desc')->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('redirect')->limit(30)->searchable(),
            TextColumn::make('personal_access_client')
                ->badge()
                ->color(fn ($state) => $state ? 'success' : 'danger')
                ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
            // TextColumn::make('password_client')
            //     ->badge()
            //     ->color(fn ($state) => $state ? 'success' : 'danger')
            //     ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),

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

    public static function getRelations(): array
    {
        return [
            RolesRelationManager::class,
        ];
    }
}
