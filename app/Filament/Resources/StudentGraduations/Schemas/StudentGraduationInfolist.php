<?php

namespace App\Filament\Resources\StudentGraduations\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class StudentGraduationInfolist
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

                Section::make('Academic Achievement')
                    ->schema([
                        TextEntry::make('acad_year')
                            ->label('Academic Year'),
                        TextEntry::make('semester')
                            ->label('Semester'),
                        TextEntry::make('major_thai')
                            ->label('Major (Thai)'),
                        TextEntry::make('major_english')
                            ->label('Major (English)'),
                        TextEntry::make('degree_thai')
                            ->label('Degree (Thai)'),
                        TextEntry::make('degree_english')
                            ->label('Degree (English)'),
                    ])->columns(2),

                Section::make('Graduation Dates')
                    ->schema([
                        TextEntry::make('graduate_date')
                            ->label('Graduate Date'),
                        TextEntry::make('concil_date')
                            ->label('Council Date'),
                        TextEntry::make('distinction')
                            ->label('Distinction'),
                    ])->columns(3),

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
