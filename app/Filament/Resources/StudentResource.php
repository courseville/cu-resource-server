<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Resources\Student;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationGroup = 'Student';

    protected static ?string $navigationLabel = 'Students';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Students';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')
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
                    ])->columns(2),

                Section::make('Additional Personal Information')
                    ->schema([
                        TextInput::make('national_id')
                            ->label('National ID')
                            ->maxLength(255),
                        DateTimePicker::make('birth')
                            ->label('Date of Birth'),
                        FileUpload::make('image')
                            ->label('Profile Image')
                            ->image()
                            ->directory('student-images')
                            ->visibility('public'),
                        TextInput::make('nationality')
                            ->label('Nationality')
                            ->maxLength(255),
                        TextInput::make('religion')
                            ->label('Religion')
                            ->maxLength(255),
                        TextInput::make('blood')
                            ->label('Blood Type')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Current Address')
                    ->schema([
                        Textarea::make('current_address')
                            ->label('Address Line')
                            ->columnSpanFull(),
                        TextInput::make('current_district')
                            ->label('District')
                            ->maxLength(255),
                        TextInput::make('current_province')
                            ->label('Province')
                            ->maxLength(255),
                        TextInput::make('current_zip_code')
                            ->label('Zip Code')
                            ->maxLength(255),
                        TextInput::make('current_latitude')
                            ->label('Latitude')
                            ->numeric(),
                        TextInput::make('current_longitude')
                            ->label('Longitude')
                            ->numeric(),
                    ])->columns(2),

                Section::make('Hometown Address')
                    ->schema([
                        Textarea::make('hometown_address')
                            ->label('Address Line')
                            ->columnSpanFull(),
                        TextInput::make('hometown_district')
                            ->label('District')
                            ->maxLength(255),
                        TextInput::make('hometown_province')
                            ->label('Province')
                            ->maxLength(255),
                        TextInput::make('hometown_zip_code')
                            ->label('Zip Code')
                            ->maxLength(255),
                        TextInput::make('hometown_latitude')
                            ->label('Latitude')
                            ->numeric(),
                        TextInput::make('hometown_longitude')
                            ->label('Longitude')
                            ->numeric(),
                    ])->columns(2),

                Section::make("Father's Information")
                    ->schema([
                        TextInput::make('father_first_name')
                            ->label('First Name')
                            ->maxLength(255),
                        TextInput::make('father_last_name')
                            ->label('Last Name')
                            ->maxLength(255),
                        TextInput::make('father_birth_year')
                            ->label('Birth Year')
                            ->numeric(),
                        TextInput::make('father_status')
                            ->label('Status')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make("Mother's Information")
                    ->schema([
                        TextInput::make('mother_first_name')
                            ->label('First Name')
                            ->maxLength(255),
                        TextInput::make('mother_last_name')
                            ->label('Last Name')
                            ->maxLength(255),
                        TextInput::make('mother_birth_year')
                            ->label('Birth Year')
                            ->numeric(),
                        TextInput::make('mother_status')
                            ->label('Status')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Parent/Guardian & Sibling Information')
                    ->schema([
                        TextInput::make('parent_relationship')
                            ->label('Relationship to Parent/Guardian')
                            ->maxLength(255),
                        TextInput::make('parent_phone')
                            ->label('Parent/Guardian Phone')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('sibling_total')
                            ->label('Total Siblings')
                            ->numeric(),
                        TextInput::make('sibling_order')
                            ->label('Sibling Order')
                            ->numeric(),
                        Textarea::make('parent_address')
                            ->label('Parent/Guardian Address Line')
                            ->columnSpanFull(),
                        TextInput::make('parent_district')
                            ->label('District')
                            ->maxLength(255),
                        TextInput::make('parent_province')
                            ->label('Province')
                            ->maxLength(255),
                        TextInput::make('parent_zip_code')
                            ->label('Zip Code')
                            ->maxLength(255),
                        TextInput::make('parent_latitude')
                            ->label('Latitude')
                            ->numeric(),
                        TextInput::make('parent_longitude')
                            ->label('Longitude')
                            ->numeric(),
                    ])->columns(2),

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
