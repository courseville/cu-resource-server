<?php

namespace App\Filament\Resources\StudentInternships;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\StudentInternships\Pages\ListStudentInternships;
use App\Filament\Resources\StudentInternships\Pages\CreateStudentInternship;
use App\Filament\Resources\StudentInternships\Pages\EditStudentInternship;
use App\Filament\Resources\StudentInternshipResource\Pages;
use App\Models\Resources\StudentInternship;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentInternshipResource extends Resource
{
    protected static ?string $model = StudentInternship::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Student Affair';

    protected static ?string $navigationLabel = 'Internships';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = 'Internships';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        Select::make('student_id')
                            ->relationship('student', 'student_id')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),

                Section::make('Internship Details')
                    ->schema([
                        Toggle::make('grant')
                            ->columnSpanFull(),
                        TextInput::make('company')
                            ->maxLength(255),
                        TextInput::make('process_step')
                            ->numeric(),
                        TextInput::make('status')
                            ->maxLength(255),
                        DatePicker::make('start_date'),
                        DatePicker::make('end_date'),
                        Textarea::make('job_description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Location Information')
                    ->schema([
                        TextInput::make('location_name')
                            ->maxLength(255),
                        TextInput::make('location_address')
                            ->maxLength(255),
                        TextInput::make('location_city')
                            ->maxLength(255),
                    ])->columns(1),

                Section::make('Supervisor Information')
                    ->schema([
                        TextInput::make('sup_name')
                            ->maxLength(255),
                        TextInput::make('sup_position')
                            ->maxLength(255),
                        TextInput::make('sup_phone')
                            ->tel()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Files')
                    ->schema([
                        FileUpload::make('file')
                            ->disk('public') // Or your preferred disk
                            ->directory('internship-files'),
                        FileUpload::make('address_pic')
                            ->disk('public') // Or your preferred disk
                            ->directory('internship-address-pics'),
                    ])->columns(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.student_id')
                    ->label('Student ID')
                    ->searchable(),
                TextColumn::make('company')
                    ->label('Company')
                    ->searchable(),
                TextColumn::make('location_city')
                    ->label('City')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date(),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->date(),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
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
            'index' => ListStudentInternships::route('/'),
            'create' => CreateStudentInternship::route('/create'),
            'edit' => EditStudentInternship::route('/{record}/edit'),
        ];
    }
}
