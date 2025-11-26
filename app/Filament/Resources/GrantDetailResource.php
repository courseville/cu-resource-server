<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrantDetailResource\Pages;
use App\Models\Resources\GrantDetail;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GrantDetailResource extends Resource
{
    protected static ?string $model = GrantDetail::class;

    protected static ?string $navigationGroup = 'Student Affair';

    protected static ?string $navigationLabel = 'Grant Detail';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Grant Detail';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Grant Details')
                    ->schema([
                        Select::make('student_id')
                            ->relationship('student', 'student_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('type')
                            ->maxLength(255)
                            ->nullable(),
                        TextInput::make('travel_cost')
                            ->numeric()
                            ->prefix('฿')
                            ->nullable(),
                        TextInput::make('accommodation_cost')
                            ->numeric()
                            ->prefix('฿')
                            ->nullable(),
                        Toggle::make('lump_sum_allowance')
                            ->nullable()
                            ->columnSpanFull(),
                        TextInput::make('first_student_id')
                            ->maxLength(255)
                            ->nullable(),
                        TextInput::make('second_student_id')
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
            'index' => Pages\ListGrantDetails::route('/'),
            'create' => Pages\CreateGrantDetail::route('/create'),
            'edit' => Pages\EditGrantDetail::route('/{record}/edit'),
        ];
    }
}
