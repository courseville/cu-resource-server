<?php

namespace App\Filament\Resources\Curriculums\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CurriculumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Curriculum Identification')
                    ->schema([
                        TextInput::make('course_code_no')
                            ->label('Course Code No.')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('major_code')
                            ->label('Major Code')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Curriculum Details')
                    ->schema([
                        TextInput::make('degree')
                            ->label('Degree')
                            ->maxLength(255),
                        TextInput::make('major')
                            ->label('Major')
                            ->maxLength(255),
                        TextInput::make('no_year_study')
                            ->label('Years of Study')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Program Settings')
                    ->schema([
                        TextInput::make('plan1')
                            ->label('Plan 1')
                            ->maxLength(255),
                        TextInput::make('language1')
                            ->label('Language 1')
                            ->maxLength(255),
                        TextInput::make('program_system')
                            ->label('Program System')
                            ->maxLength(255),
                        TextInput::make('calendar')
                            ->label('Calendar')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Academic Start')
                    ->schema([
                        TextInput::make('begin_year')
                            ->label('Begin Year')
                            ->maxLength(255),
                        TextInput::make('begin_semester')
                            ->label('Begin Semester')
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
