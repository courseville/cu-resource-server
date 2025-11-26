<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RetiredPersonnelResource\Pages;
use App\Models\Resources\RetiredPersonnel;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RetiredPersonnelResource extends Resource
{
    protected static ?string $model = RetiredPersonnel::class;

    protected static ?string $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Retired';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Retired';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Retired Details')
                    ->schema([
                        Select::make('personnel_id')
                            ->relationship('personnel', 'personnel_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('retired_id')
                            ->maxLength(255)
                            ->nullable(),
                        DateTimePicker::make('date')
                            ->nullable(),
                        TextInput::make('type')
                            ->maxLength(255)
                            ->nullable(),
                        TextInput::make('citizen_id')
                            ->maxLength(255)
                            ->nullable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRetiredPersonnels::route('/'),
            'create' => Pages\CreateRetiredPersonnel::route('/create'),
            'edit' => Pages\EditRetiredPersonnel::route('/{record}/edit'),
        ];
    }
}
