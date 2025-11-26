<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonnelSalaryResource\Pages;
use App\Models\Resources\PersonnelSalary;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PersonnelSalaryResource extends Resource
{
    protected static ?string $model = PersonnelSalary::class;

    protected static ?string $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Salary';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Salary';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Salary Details')
                    ->schema([
                        Select::make('personnel_id')
                            ->relationship('personnel', 'personnel_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('salary')
                            ->maxLength(255)
                            ->nullable(),
                        DateTimePicker::make('start_date')
                            ->nullable(),
                        DateTimePicker::make('end_date')
                            ->nullable(),
                        Textarea::make('detail')
                            ->columnSpanFull()
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
            'index' => Pages\ListPersonnelSalaries::route('/'),
            'create' => Pages\CreatePersonnelSalary::route('/create'),
            'edit' => Pages\EditPersonnelSalary::route('/{record}/edit'),
        ];
    }
}
