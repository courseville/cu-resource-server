<?php

namespace App\Filament\Resources\StudentCurriculums\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class StudentCurriculumInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Identification')
                    ->schema([
                        TextEntry::make('student_code')
                            ->label('Student Code'),
                        TextEntry::make('name_thai')
                            ->label('Name (Thai)'),
                        TextEntry::make('name_english')
                            ->label('Name (English)'),
                    ])->columns(2),

                Section::make('Academic Record')
                    ->schema([
                        TextEntry::make('year')
                            ->label('Year'),
                        TextEntry::make('semester')
                            ->label('Semester'),
                        TextEntry::make('course_code')
                            ->label('Course Code'),
                        TextEntry::make('course_name')
                            ->label('Course Name'),
                        TextEntry::make('section')
                            ->label('Section'),
                        TextEntry::make('grade')
                            ->label('Grade'),
                        TextEntry::make('credit_tot')
                            ->label('Credit Total'),
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
