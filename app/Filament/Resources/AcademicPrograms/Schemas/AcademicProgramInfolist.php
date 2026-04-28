<?php

namespace App\Filament\Resources\AcademicPrograms\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AcademicProgramInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Program Identification')
                    ->schema([
                        TextEntry::make('oaa_program_id')
                            ->label('OAA Program ID'),
                        TextEntry::make('ops_no')
                            ->label('OPS No.'),
                    ])->columns(2),

                Section::make('Program Names')
                    ->schema([
                        TextEntry::make('program_name_th')
                            ->label('Program Name (Thai)'),
                        TextEntry::make('program_name_en')
                            ->label('Program Name (English)'),
                    ])->columns(2),

                Section::make('Degree Information')
                    ->schema([
                        TextEntry::make('title_degree_th')
                            ->label('Degree Title (Thai)'),
                        TextEntry::make('title_degree_en')
                            ->label('Degree Title (English)'),
                        TextEntry::make('degree_name_th')
                            ->label('Degree Name (Thai)'),
                        TextEntry::make('degree_name_en')
                            ->label('Degree Name (English)'),
                    ])->columns(2),

                Section::make('Additional Information')
                    ->schema([
                        TextEntry::make('faculty_code')
                            ->label('Faculty Code'),
                        TextEntry::make('level_code')
                            ->label('Level Code'),
                    ])->columns(2),
            ]);
    }
}
