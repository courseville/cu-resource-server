<?php

namespace App\Filament\Resources\StudentStatusHistories\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentStatusHistoryForm
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

                Section::make('Status Details')
                    ->schema([
                        TextInput::make('status')
                            ->label('Status')
                            ->maxLength(255),
                        DatePicker::make('effect_date')
                            ->label('Effect Date'),
                    ])->columns(2),

                Section::make('Academic Period')
                    ->schema([
                        TextInput::make('from_acad_year')
                            ->label('From Academic Year')
                            ->maxLength(255),
                        TextInput::make('from_semester')
                            ->label('From Semester')
                            ->maxLength(255),
                        TextInput::make('to_acad_year')
                            ->label('To Academic Year')
                            ->maxLength(255),
                        TextInput::make('to_semester')
                            ->label('To Semester')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Documents')
                    ->schema([
                        TextInput::make('instruction_no')
                            ->label('Instruction No.')
                            ->maxLength(255),
                        TextInput::make('announcement')
                            ->label('Announcement')
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
