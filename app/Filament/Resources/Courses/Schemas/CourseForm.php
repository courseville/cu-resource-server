<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Identification')
                    ->schema([
                        TextInput::make('course_id')
                            ->label('Course ID')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('course_no')
                            ->label('Course No.')
                            ->maxLength(255),
                        TextInput::make('program_id')
                            ->label('Program ID')
                            ->maxLength(255),
                        TextInput::make('revision_year')
                            ->label('Revision Year')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Course Names')
                    ->schema([
                        TextInput::make('name_th')
                            ->label('Course Name (Thai)')
                            ->maxLength(255),
                        TextInput::make('name_en')
                            ->label('Course Name (English)')
                            ->maxLength(255),
                        TextInput::make('name_abbr')
                            ->label('Abbreviated Name')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Credits & Hours')
                    ->schema([
                        TextInput::make('credits')
                            ->label('Total Credits')
                            ->numeric(),
                        TextInput::make('l_credit')
                            ->label('Lecture Support Credits')
                            ->numeric(),
                        TextInput::make('nl_credit')
                            ->label('Non-Lecture Support Credits')
                            ->numeric(),
                        TextInput::make('l_hour')
                            ->label('Lecture Hours')
                            ->numeric(),
                        TextInput::make('nl_hour')
                            ->label('Non-Lecture Hours')
                            ->numeric(),
                        TextInput::make('s_hour')
                            ->label('Self-Study Hours')
                            ->numeric(),
                    ])->columns(3),

                Section::make('Descriptions')
                    ->schema([
                        Textarea::make('description_th')
                            ->label('Description (Thai)')
                            ->columnSpanFull(),
                        Textarea::make('description_en')
                            ->label('Description (English)')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
