<?php

namespace App\Filament\Resources\Users;

use Filament\Schemas\Schema;
use App\Filament\Exports\UserExporter;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email Address')
                    ->required()
                    ->email()
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password')
                    ->required()
                    ->minLength(8)
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),

                Select::make('roles')
                    ->label('Roles')
                    ->relationship('roles', 'name') // Define the relationship and display field
                    ->multiple() // Allow multiple selections
                    ->preload(), // Preload options for better performance
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('roles')
                    ->label('Roles')
                    ->formatStateUsing(function ($record) {
                        // Concatenate role names into a single string
                        return $record->roles->pluck('name')->join(', ');
                    })
                    ->limit(50), // Limit the number of characters displayed
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(UserExporter::class),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
