<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name_th')
                            ->label('Last Name (TH)')
                            ->required()
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
                        TextInput::make('national_id')
                            ->label('National ID')
                            ->required()
                            ->maxLength(255),
                        DateTimePicker::make('birth')
                            ->label('Birth Date'),
                        FileUpload::make('image')
                            ->label('Student Image')
                            ->image()
                            ->directory('student-images'),
                    ])->columns(2),

                Section::make('Additional Personal Information')
                    ->schema([
                        TextInput::make('nationality')
                            ->label('Nationality')
                            ->maxLength(255),
                        TextInput::make('religion')
                            ->label('Religion')
                            ->maxLength(255),
                        TextInput::make('blood')
                            ->label('Blood Type')
                            ->maxLength(255),
                    ])->columns(3),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Addresses')
                    ->schema([
                        Textarea::make('current_address')
                            ->label('Current Address')
                            ->columnSpanFull(),
                        TextInput::make('current_district')
                            ->label('Current District'),
                        TextInput::make('current_province')
                            ->label('Current Province'),
                        TextInput::make('current_zip_code')
                            ->label('Current Zip Code'),
                        Textarea::make('hometown_address')
                            ->label('Hometown Address')
                            ->columnSpanFull(),
                        TextInput::make('hometown_district')
                            ->label('Hometown District'),
                        TextInput::make('hometown_province')
                            ->label('Hometown Province'),
                        TextInput::make('hometown_zip_code')
                            ->label('Hometown Zip Code'),
                    ])->columns(3),

                Section::make('Parents Information')
                    ->schema([
                        TextInput::make('father_first_name')
                            ->label('Father First Name'),
                        TextInput::make('father_last_name')
                            ->label('Father Last Name'),
                        TextInput::make('father_status')
                            ->label('Father Status'),
                        TextInput::make('mother_first_name')
                            ->label('Mother First Name'),
                        TextInput::make('mother_last_name')
                            ->label('Mother Last Name'),
                        TextInput::make('mother_status')
                            ->label('Mother Status'),
                    ])->columns(3),

                Section::make('Enrollment & Academic Information')
                    ->schema([
                        TextInput::make('faccode')
                            ->label('Faculty Code'),
                        TextInput::make('depcode')
                            ->label('Department Code'),
                        TextInput::make('course_code_no')
                            ->label('Course Code No.'),
                        TextInput::make('faculty_group')
                            ->label('Faculty Group'),
                        TextInput::make('major_code')
                            ->label('Major Code'),
                        TextInput::make('program_code')
                            ->label('Program Code'),
                        TextInput::make('study_program_system')
                            ->label('Study Program System'),
                        TextInput::make('project_code')
                            ->label('Project Code'),
                        TextInput::make('start_acad_year')
                            ->label('Start Academic Year'),
                        TextInput::make('start_semester')
                            ->label('Start Semester'),
                        TextInput::make('credit_tot')
                            ->label('Total Credits')
                            ->numeric(),
                        TextInput::make('fac_name')
                            ->label('Faculty Name'),
                        TextInput::make('dep_name')
                            ->label('Department Name'),
                        TextInput::make('major_name')
                            ->label('Major Name'),
                    ])->columns(2),
            ]);
    }
}
