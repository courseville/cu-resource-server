<?php

namespace App\Filament\Resources\StudentApplications;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\StudentApplications\Pages\ListStudentApplications;
use App\Filament\Resources\StudentApplications\Pages\CreateStudentApplication;
use App\Filament\Resources\StudentApplications\Pages\EditStudentApplication;
use App\Filament\Resources\StudentApplicationResource\Pages;
use App\Models\Resources\StudentApplication;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentApplicationResource extends Resource
{
    protected static ?string $model = StudentApplication::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Academic';

    protected static ?string $navigationLabel = 'Student Application';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Student Applications';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('application_id')
                    ->required()
                    ->maxLength(255),
                TextInput::make('citizen_id')
                    ->required()
                    ->maxLength(255),
                TextInput::make('transcript_title')
                    ->maxLength(255),
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('student_type')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('application_id')
                    ->searchable(),
                TextColumn::make('citizen_id')
                    ->searchable(),
                TextColumn::make('transcript_title')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('student_type')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ListStudentApplications::route('/'),
            'create' => CreateStudentApplication::route('/create'),
            'edit' => EditStudentApplication::route('/{record}/edit'),
        ];
    }
}
