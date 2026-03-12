<?php

namespace App\Filament\Resources\FulltimePersonnels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class FulltimePersonnelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        Select::make('personnel_id')
                            ->relationship('personnel', 'personnel_id')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('full_time_id')
                            ->label('Full-time ID')
                            ->maxLength(255)
                            ->nullable(),
                        Select::make('job_type')
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Contract' => 'Contract',
                            ])
                            ->nullable(),
                    ])->columns(3),

                Section::make('Education Details')
                    ->schema([
                        TextInput::make('university')
                            ->maxLength(255)
                            ->nullable(),
                        TextInput::make('degree')
                            ->maxLength(255)
                            ->nullable(),
                        Select::make('education_level')
                            ->options([
                                'Bachelors' => 'Bachelors',
                                'Masters' => 'Masters',
                                'PhD' => 'PhD',
                                'Diploma' => 'Diploma',
                            ])
                            ->nullable(),
                    ])->columns(3),

                Section::make('Appointment and Promotion Dates')
                    ->schema([
                        DatePicker::make('date_of_appointment')
                            ->nullable(),
                        DatePicker::make('asst_prof_date')
                            ->label('Assistant Professor Date')
                            ->nullable(),
                        DatePicker::make('prof_date')
                            ->label('Professor Date')
                            ->nullable(),
                        DatePicker::make('assoc_prof_date')
                            ->label('Associate Professor Date')
                            ->nullable(),
                        DatePicker::make('teacher_date')
                            ->nullable(),
                    ])->columns(3),

                Section::make('Personal and Salary Details')
                    ->schema([
                        DatePicker::make('birth_date')
                            ->nullable(),
                        TextInput::make('age')
                            ->numeric()
                            ->nullable(),
                        DatePicker::make('personnel_status_changing_date')
                            ->nullable(),
                        TextInput::make('salary_band')
                            ->numeric()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
