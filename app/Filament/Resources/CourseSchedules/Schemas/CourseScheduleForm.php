<?php

namespace App\Filament\Resources\CourseSchedules\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CourseScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
->components([
                Section::make('Schedule Identification')
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
                    ])->columns(2),

                Section::make('Section Details')
                    ->schema([
                        TextInput::make('section')
                            ->label('Section')
                            ->maxLength(255),
                        TextInput::make('row_seq')
                            ->label('Row Seq')
                            ->maxLength(255),
                        TextInput::make('teach_type')
                            ->label('Teach Type')
                            ->maxLength(255),
                    ])->columns(3),

                Section::make('Time & Day')
                    ->schema([
                        TextInput::make('daycode')
                            ->label('Day Code')
                            ->maxLength(255),
                        TextInput::make('teach_time_from')
                            ->label('Time From')
                            ->maxLength(255),
                        TextInput::make('teach_time_to')
                            ->label('Time To')
                            ->maxLength(255),
                    ])->columns(3),

                Section::make('Institutional Hierarchy')
                    ->schema([
                        TextInput::make('faccode')
                            ->label('Faculty Code')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
