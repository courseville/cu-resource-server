<?php

namespace App\Filament\Resources\StudentInternships\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class StudentInternshipForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        TextInput::make('student_code')
                            ->label('Student Code')
                            ->required()
                            ->maxLength(255),
                        Select::make('student_id')
                            ->relationship('student', 'student_id')
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Section::make('Academic & Institution')
                    ->schema([
                        TextInput::make('acad_year')
                            ->label('Academic Year')
                            ->maxLength(255),
                        TextInput::make('semester')
                            ->label('Semester')
                            ->maxLength(255),
                        TextInput::make('faccode')
                            ->label('Faculty Code')
                            ->maxLength(255),
                        TextInput::make('depcode')
                            ->label('Department Code')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Internship Details')
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Company Name')
                            ->maxLength(255),
                        Toggle::make('grant')
                            ->label('Has Grant'),
                        TextInput::make('process_step')
                            ->numeric(),
                        TextInput::make('status')
                            ->maxLength(255),
                        DatePicker::make('start_date'),
                        DatePicker::make('end_date'),
                        Textarea::make('job_description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Location & Supervisor')
                    ->schema([
                        TextInput::make('location_name')
                            ->maxLength(255),
                        TextInput::make('location_address')
                            ->maxLength(255),
                        TextInput::make('location_city')
                            ->maxLength(255),
                        TextInput::make('sup_name')
                            ->label('Supervisor Name')
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
                            ->directory('internship-files'),
                        FileUpload::make('address_pic')
                            ->label('Address Picture')
                            ->directory('internship-address-pics'),
                    ])->columns(2),
            ]);
    }
}
