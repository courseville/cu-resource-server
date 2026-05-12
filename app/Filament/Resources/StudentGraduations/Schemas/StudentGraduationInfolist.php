<?php

namespace App\Filament\Resources\StudentGraduations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentGraduationInfolist
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

                Section::make('Academic Achievement')
                    ->schema([
                        TextEntry::make('acad_year')
                            ->label('Academic Year')
                            ->withSyncMeta(),
                        TextEntry::make('semester')
                            ->label('Semester')
                            ->withSyncMeta(),
                        TextEntry::make('major_thai')
                            ->label('Major (Thai)')
                            ->withSyncMeta(),
                        TextEntry::make('major_english')
                            ->label('Major (English)')
                            ->withSyncMeta(),
                        TextEntry::make('degree_thai')
                            ->label('Degree (Thai)')
                            ->withSyncMeta(),
                        TextEntry::make('degree_english')
                            ->label('Degree (English)')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Graduation Dates')
                    ->schema([
                        TextEntry::make('graduate_date')
                            ->label('Graduate Date')
                            ->withSyncMeta(),
                        TextEntry::make('concil_date')
                            ->label('Council Date')
                            ->withSyncMeta(),
                        TextEntry::make('distinction')
                            ->label('Distinction')
                            ->withSyncMeta(),
                    ])->columns(3),

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
