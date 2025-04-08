<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestUserResource\Pages;
use App\Models\TestUser;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TestUserResource extends Resource
{
    protected static ?string $model = TestUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('id'),
                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('data_source_id')->label('Data Source Id'),
                TextColumn::make('data_id')->label('Data Id'),
            ])
            ->filters([
                //
            ])
            ->actions([
                DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTestUsers::route('/'),
            'create' => Pages\CreateTestUser::route('/create'),
            'edit' => Pages\EditTestUser::route('/{record}/edit'),
        ];
    }
}
