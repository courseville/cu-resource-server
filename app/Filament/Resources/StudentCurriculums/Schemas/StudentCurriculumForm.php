<?php

namespace App\Filament\Resources\StudentCurriculums\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class StudentCurriculumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Identification')
                    ->schema([
                        TextInput::make('student_code')
                            ->label('Student Code')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('name_thai')
                            ->label('Name (Thai)')
                            ->maxLength(255),
                        TextInput::make('name_english')
                            ->label('Name (English)')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Academic Record')
                    ->schema([
                        TextInput::make('year')
                            ->label('Year')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('semester')
                            ->label('Semester')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('course_code')
                            ->label('Course Code')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('course_name')
                            ->label('Course Name')
                            ->maxLength(255),
                        TextInput::make('section')
                            ->label('Section')
                            ->maxLength(255),
                        TextInput::make('grade')
                            ->label('Grade')
                            ->maxLength(255),
                        TextInput::make('credit_tot')
                            ->label('Credit Total')
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
