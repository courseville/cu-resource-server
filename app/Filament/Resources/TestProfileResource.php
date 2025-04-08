<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestProfileResource\Pages;
use App\Filament\Resources\TestProfileResource\RelationManagers;
use App\Models\TestProfile;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;

class TestProfileResource extends Resource
{
    protected static ?string $model = TestProfile::class;

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
                TextColumn::make('test_user_id')->label('Test User Id'),
                TextColumn::make('bio')->label('Bio'),
                TextColumn::make('avatar')->label('Avatar'),
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
            'index' => Pages\ListTestProfiles::route('/'),
            'create' => Pages\CreateTestProfile::route('/create'),
            'edit' => Pages\EditTestProfile::route('/{record}/edit'),
        ];
    }
}
