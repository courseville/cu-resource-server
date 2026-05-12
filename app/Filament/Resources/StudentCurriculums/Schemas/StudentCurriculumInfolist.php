<?php

namespace App\Filament\Resources\StudentCurriculums\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentCurriculumInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Identification')
                    ->schema([
                        TextEntry::make('student_code')
                            ->label('Student Code')
                            ->withSyncMeta(),
                        TextEntry::make('name_thai')
                            ->label('Name (Thai)')
                            ->withSyncMeta(),
                        TextEntry::make('name_english')
                            ->label('Name (English)')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Academic Record')
                    ->schema([
                        TextEntry::make('year')
                            ->label('Year')
                            ->withSyncMeta(),
                        TextEntry::make('semester')
                            ->label('Semester')
                            ->withSyncMeta(),
                        TextEntry::make('course_code')
                            ->label('Course Code')
                            ->withSyncMeta(),
                        TextEntry::make('course_name')
                            ->label('Course Name')
                            ->withSyncMeta(),
                        TextEntry::make('section')
                            ->label('Section')
                            ->withSyncMeta(),
                        TextEntry::make('grade')
                            ->label('Grade')
                            ->withSyncMeta(),
                        TextEntry::make('credit_tot')
                            ->label('Credit Total')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Institutional Hierarchy')
                    ->schema([
                        TextEntry::make('faccode')
                            ->label('Faculty Code')
                            ->withSyncMeta(),
                        TextEntry::make('depcode')
                            ->label('Department Code')
                            ->withSyncMeta(),
                        TextEntry::make('majorcode')
                            ->label('Major Code')
                            ->withSyncMeta(),
                    ])->columns(3),
            ]);
    }
}
