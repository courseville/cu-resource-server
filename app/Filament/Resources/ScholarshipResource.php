<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScholarshipResource\Pages;
use App\Models\Resources\Scholarship;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ScholarshipResource extends Resource
{
    protected static ?string $model = Scholarship::class;

    protected static ?string $navigationGroup = 'Student Affair';

    protected static ?string $navigationLabel = 'Scholarships';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Scholarships';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Scholarship Details')
                    ->schema([
                        TextInput::make('scholarship_name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->nullable()
                            ->rows(5),
                        FileUpload::make('file')
                            ->nullable()
                            ->disk('public') // Or your preferred disk
                            ->directory('scholarship-files'),
                        Textarea::make('file_description')
                            ->nullable()
                            ->rows(3),
                        TextInput::make('academic_year')
                            ->required()
                            ->numeric(),
                    ]),
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
            'index' => Pages\ListScholarships::route('/'),
            'create' => Pages\CreateScholarship::route('/create'),
            'edit' => Pages\EditScholarship::route('/{record}/edit'),
        ];
    }
}
