<?php

namespace App\Filament\Resources\StudentAdmissions\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class StudentAdmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Admission Identification')
                    ->schema([
                        TextEntry::make('student_code')
                            ->label('Student Code'),
                        TextEntry::make('admission_type')
                            ->label('Admission Type'),
                    ])->columns(2),

                Section::make('Applicant Details')
                    ->schema([
                        TextEntry::make('name_thai')
                            ->label('Name (Thai)'),
                        TextEntry::make('name_english')
                            ->label('Name (English)'),
                    ])->columns(2),

                Section::make('Application Record')
                    ->schema([
                        TextEntry::make('apply_year')
                            ->label('Apply Year'),
                        TextEntry::make('apply_semester')
                            ->label('Apply Semester'),
                        TextEntry::make('apply_date')
                            ->date(),
                        TextEntry::make('apply_status')
                            ->label('Apply Status'),
                    ])->columns(2),

                Section::make('Institutional Hierarchy')
                    ->schema([
                        TextEntry::make('faccode')
                            ->label('Faculty Code'),
                        TextEntry::make('depcode')
                            ->label('Department Code'),
                        TextEntry::make('majorcode')
                            ->label('Major Code'),
                    ])->columns(3),
            ]);
    }
}
