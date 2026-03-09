<?php

namespace App\Filament\Resources\GrantDetails;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\GrantDetails\Pages\ListGrantDetails;
use App\Filament\Resources\GrantDetails\Pages\CreateGrantDetail;
use App\Filament\Resources\GrantDetails\Pages\EditGrantDetail;
use App\Filament\Resources\GrantDetailResource\Pages;
use App\Models\Resources\GrantDetail;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GrantDetailResource extends Resource
{
    protected static ?string $model = GrantDetail::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Student Affair';

    protected static ?string $navigationLabel = 'Grant Detail';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Grant Detail';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                TextColumn::make('student.student_id')
                    ->label('Student ID')
                    ->searchable(),
                TextColumn::make('type'),
                TextColumn::make('travel_cost'),
                TextColumn::make('accommodation_cost'),
                BooleanColumn::make('lump_sum_allowance'),
                TextColumn::make('first_student_id'),
                TextColumn::make('second_student_id'),
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
            'index' => ListGrantDetails::route('/'),
            'create' => CreateGrantDetail::route('/create'),
            'edit' => EditGrantDetail::route('/{record}/edit'),
        ];
    }
}
