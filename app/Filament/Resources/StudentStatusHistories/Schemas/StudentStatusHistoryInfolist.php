<?php

namespace App\Filament\Resources\StudentStatusHistories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentStatusHistoryInfolist
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

                Section::make('Status Details')
                    ->schema([
                        TextEntry::make('status')
                            ->label('Status'),
                        TextEntry::make('effect_date')
                            ->label('Effect Date')
                            ->date(),
                    ])->columns(2),

                Section::make('Academic Period')
                    ->schema([
                        TextEntry::make('from_acad_year')
                            ->label('From Academic Year'),
                        TextEntry::make('from_semester')
                            ->label('From Semester'),
                        TextEntry::make('to_acad_year')
                            ->label('To Academic Year'),
                        TextEntry::make('to_semester')
                            ->label('To Semester'),
                    ])->columns(2),

                Section::make('Documents')
                    ->schema([
                        TextEntry::make('instruction_no')
                            ->label('Instruction No.'),
                        TextEntry::make('announcement')
                            ->label('Announcement'),
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
