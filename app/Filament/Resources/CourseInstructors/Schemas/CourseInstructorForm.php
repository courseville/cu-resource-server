<?php

namespace App\Filament\Resources\CourseInstructors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseInstructorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Assignment')
                    ->schema([
                        TextInput::make('acad_year')
                            ->label('Academic Year')
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
                        TextInput::make('section')
                            ->label('Section')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Instructor Details')
                    ->schema([
                        TextInput::make('instructor_no')
                            ->label('Instructor No.')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('instructor_name')
                            ->label('Instructor Name (Thai)')
                            ->maxLength(255),
                        TextInput::make('instructor_name_en')
                            ->label('Instructor Name (English)')
                            ->maxLength(255),
                        TextInput::make('row_seq')
                            ->label('Row Seq')
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
                    ])->columns(2),
            ]);
    }
}
