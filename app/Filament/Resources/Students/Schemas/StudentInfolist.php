<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextEntry::make('student_id')
                            ->label('Student ID'),
                        TextEntry::make('full_name_th')
                            ->label('Full Name (Thai)'),
                        TextEntry::make('full_name_en')
                            ->label('Full Name (English)'),
                        TextEntry::make('national_id')
                            ->label('National ID'),
                        TextEntry::make('birth')
                            ->date(),
                    ])->columns(2),

                Section::make('Enrollment & Academic Information')
                    ->schema([
                        TextEntry::make('fac_name')
                            ->label('Faculty'),
                        TextEntry::make('dep_name')
                            ->label('Department'),
                        TextEntry::make('major_name')
                            ->label('Major'),
                        TextEntry::make('start_acad_year')
                            ->label('Start Year'),
                        TextEntry::make('credit_tot')
                            ->label('Total Credits'),
                    ])->columns(2),
            ]);
    }
}
