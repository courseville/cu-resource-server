<?php

namespace App\Filament\Resources\AcademicPrograms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AcademicProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Program Identification')
                    ->schema([
                        TextInput::make('oaa_program_id')
                            ->label('OAA Program ID')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('ops_no')
                            ->label('OPS No.')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Program Names')
                    ->schema([
                        TextInput::make('program_name_th')
                            ->label('Program Name (Thai)')
                            ->maxLength(255),
                        TextInput::make('program_name_en')
                            ->label('Program Name (English)')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Degree Information')
                    ->schema([
                        TextInput::make('title_degree_th')
                            ->label('Degree Title (Thai)')
                            ->maxLength(255),
                        TextInput::make('title_degree_en')
                            ->label('Degree Title (English)')
                            ->maxLength(255),
                        TextInput::make('degree_name_th')
                            ->label('Degree Name (Thai)')
                            ->maxLength(255),
                        TextInput::make('degree_name_en')
                            ->label('Degree Name (English)')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Additional Information')
                    ->schema([
                        TextInput::make('faculty_code')
                            ->label('Faculty Code')
                            ->maxLength(255),
                        TextInput::make('level_code')
                            ->label('Level Code')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
