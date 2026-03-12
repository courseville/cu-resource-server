<?php

namespace App\Filament\Resources\StudentInternships\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;

class StudentInternshipInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->schema([
                        TextEntry::make('student_code')
                            ->label('Student Code'),
                        TextEntry::make('student.student_id')
                            ->label('Related Student ID'),
                    ])->columns(2),

                Section::make('Academic & Institution')
                    ->schema([
                        TextEntry::make('acad_year')
                            ->label('Academic Year'),
                        TextEntry::make('semester')
                            ->label('Semester'),
                        TextEntry::make('faccode')
                            ->label('Faculty Code'),
                        TextEntry::make('depcode')
                            ->label('Department Code'),
                    ])->columns(2),

                Section::make('Internship Details')
                    ->schema([
                        TextEntry::make('company_name')
                            ->label('Company Name'),
                        TextEntry::make('status')
                            ->label('Status'),
                        TextEntry::make('start_date')
                            ->date(),
                        TextEntry::make('end_date')
                            ->date(),
                    ])->columns(2),

                Section::make('Location & Supervisor')
                    ->schema([
                        TextEntry::make('location_name'),
                        TextEntry::make('location_address'),
                        TextEntry::make('location_city'),
                        TextEntry::make('sup_name')
                            ->label('Supervisor Name'),
                        TextEntry::make('sup_phone')
                            ->label('Supervisor Phone'),
                    ])->columns(2),

                Section::make('Files')
                    ->schema([
                        ImageEntry::make('address_pic')
                            ->label('Address Picture'),
                    ])->columns(1),
            ]);
    }
}
