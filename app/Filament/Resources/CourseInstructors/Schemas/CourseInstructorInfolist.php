<?php

namespace App\Filament\Resources\CourseInstructors\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class CourseInstructorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Assignment')
                    ->schema([
                        TextEntry::make('acad_year')
                            ->label('Academic Year'),
                        TextEntry::make('semester')
                            ->label('Semester'),
                        TextEntry::make('course_code')
                            ->label('Course Code'),
                        TextEntry::make('section')
                            ->label('Section'),
                    ])->columns(2),

                Section::make('Instructor Details')
                    ->schema([
                        TextEntry::make('instructor_no')
                            ->label('Instructor No.'),
                        TextEntry::make('instructor_name')
                            ->label('Instructor Name (Thai)'),
                        TextEntry::make('instructor_name_en')
                            ->label('Instructor Name (English)'),
                        TextEntry::make('row_seq')
                            ->label('Row Seq'),
                    ])->columns(2),

                Section::make('Institutional Hierarchy')
                    ->schema([
                        TextEntry::make('faccode')
                            ->label('Faculty Code'),
                        TextEntry::make('depcode')
                            ->label('Department Code'),
                    ])->columns(2),
            ]);
    }
}
