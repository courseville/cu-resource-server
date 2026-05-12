<?php

namespace App\Filament\Resources\Curriculums\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CurriculumInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Curriculum Identification')
                    ->schema([
                        TextEntry::make('course_code_no')
                            ->label('Course Code No.')
                            ->withSyncMeta(),
                        TextEntry::make('major_code')
                            ->label('Major Code')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Curriculum Details')
                    ->schema([
                        TextEntry::make('degree')
                            ->label('Degree')
                            ->withSyncMeta(),
                        TextEntry::make('major')
                            ->label('Major')
                            ->withSyncMeta(),
                        TextEntry::make('no_year_study')
                            ->label('Years of Study')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Program Settings')
                    ->schema([
                        TextEntry::make('plan1')
                            ->label('Plan 1')
                            ->withSyncMeta(),
                        TextEntry::make('language1')
                            ->label('Language 1')
                            ->withSyncMeta(),
                        TextEntry::make('program_system')
                            ->label('Program System')
                            ->withSyncMeta(),
                        TextEntry::make('calendar')
                            ->label('Calendar')
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Academic Start')
                    ->schema([
                        TextEntry::make('begin_year')
                            ->label('Begin Year')
                            ->withSyncMeta(),
                        TextEntry::make('begin_semester')
                            ->label('Begin Semester')
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
                    ])->columns(2),
            ]);
    }
}
