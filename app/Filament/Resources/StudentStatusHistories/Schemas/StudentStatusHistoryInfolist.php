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
                            ->label('Student Code')
                            ->withSyncMeta(),
                        TextEntry::make('name_thai')
                            ->label('Name (Thai)')
                            ->withSyncMeta(),
                        TextEntry::make('name_english')
                            ->label('Name (English)')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Status Details')
                    ->schema([
                        TextEntry::make('status')
                            ->label('Status')
                            ->withSyncMeta(),
                        TextEntry::make('effect_date')
                            ->label('Effect Date')
                            ->date()
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Academic Period')
                    ->schema([
                        TextEntry::make('from_acad_year')
                            ->label('From Academic Year')
                            ->withSyncMeta(),
                        TextEntry::make('from_semester')
                            ->label('From Semester')
                            ->withSyncMeta(),
                        TextEntry::make('to_acad_year')
                            ->label('To Academic Year')
                            ->withSyncMeta(),
                        TextEntry::make('to_semester')
                            ->label('To Semester')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Documents')
                    ->schema([
                        TextEntry::make('instruction_no')
                            ->label('Instruction No.')
                            ->withSyncMeta(),
                        TextEntry::make('announcement')
                            ->label('Announcement')
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
