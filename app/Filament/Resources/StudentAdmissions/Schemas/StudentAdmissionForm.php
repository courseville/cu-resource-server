<?php

namespace App\Filament\Resources\StudentAdmissions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentAdmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Admission Identification')
                    ->schema([
                        TextInput::make('student_code')
                            ->label('Student Code')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('admission_type')
                            ->label('Admission Type')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Applicant Details')
                    ->schema([
                        TextInput::make('name_thai')
                            ->label('Name (Thai)')
                            ->maxLength(255),
                        TextInput::make('name_english')
                            ->label('Name (English)')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Application Record')
                    ->schema([
                        TextInput::make('apply_year')
                            ->label('Apply Year')
                            ->maxLength(255),
                        TextInput::make('apply_semester')
                            ->label('Apply Semester')
                            ->maxLength(255),
                        DatePicker::make('apply_date')
                            ->label('Apply Date'),
                        TextInput::make('apply_status')
                            ->label('Apply Status')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Institutional Hierarchy')
                    ->schema([
                        TextInput::make('faccode')
                            ->label('Faculty Code')
                            ->maxLength(255),
                        TextInput::make('depcode')
                            ->label('Department Code')
                            ->maxLength(255),
                        TextInput::make('majorcode')
                            ->label('Major Code')
                            ->maxLength(255),
                    ])->columns(3),
            ]);
    }
}
