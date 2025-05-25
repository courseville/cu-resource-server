<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Resources\Student;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationGroup = 'Resources';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('student_id')
                    ->label('Student ID')
                    ->required()
                    ->maxLength(255),
                TextInput::make('title_th')
                    ->label('Title (TH)')
                    ->maxLength(255),
                TextInput::make('first_name_th')
                    ->label('First Name (TH)')
                    ->maxLength(255),
                TextInput::make('last_name_th')
                    ->label('Last Name (TH)')
                    ->maxLength(255),
                TextInput::make('title_en')
                    ->label('Title (EN)')
                    ->maxLength(255),
                TextInput::make('first_name_en')
                    ->label('First Name (EN)')
                    ->maxLength(255),
                TextInput::make('last_name_en')
                    ->label('Last Name (EN)')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_id')
                    ->label('Student ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title_th')
                    ->label('Title (TH)'),
                TextColumn::make('first_name_th')
                    ->label('First Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_name_th')
                    ->label('Last Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title_en')
                    ->label('Title (EN)'),
                TextColumn::make('first_name_en')
                    ->label('First Name (EN)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_name_en')
                    ->label('Last Name (EN)')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
