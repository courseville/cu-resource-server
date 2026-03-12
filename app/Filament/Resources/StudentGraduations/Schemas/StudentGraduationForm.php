<?php

namespace App\Filament\Resources\StudentGraduations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;

class StudentGraduationForm
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

                Section::make('Academic Achievement')
                    ->schema([
                        TextInput::make('acad_year')
                            ->label('Academic Year')
                            ->maxLength(255),
                        TextInput::make('semester')
                            ->label('Semester')
                            ->maxLength(255),
                        TextInput::make('major_thai')
                            ->label('Major (Thai)')
                            ->maxLength(255),
                        TextInput::make('major_english')
                            ->label('Major (English)')
                            ->maxLength(255),
                        TextInput::make('degree_thai')
                            ->label('Degree (Thai)')
                            ->maxLength(255),
                        TextInput::make('degree_english')
                            ->label('Degree (English)')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Graduation Dates')
                    ->schema([
                        TextInput::make('graduate_date')
                            ->label('Graduate Date (Original)'),
                        TextInput::make('concil_date')
                            ->label('Council Date (Original)'),
                        TextInput::make('distinction')
                            ->label('Distinction')
                            ->maxLength(255),
                    ])->columns(3),

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
