<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Identification')
                    ->schema([
                        TextEntry::make('course_id')
                            ->label('Course ID')
                            ->withSyncMeta(),
                        TextEntry::make('course_no')
                            ->label('Course No.')
                            ->withSyncMeta(),
                        TextEntry::make('program_id')
                            ->label('Program ID')
                            ->withSyncMeta(),
                        TextEntry::make('revision_year')
                            ->label('Revision Year')
                            ->withSyncMeta(),
                    ])->columns(2)
                    ->columnSpanFull(),

                Section::make('Course Names')
                    ->schema([
                        TextEntry::make('name_th')
                            ->label('Course Name (Thai)')
                            ->withSyncMeta(),
                        TextEntry::make('name_en')
                            ->label('Course Name (English)')
                            ->withSyncMeta(),
                        TextEntry::make('name_abbr')
                            ->label('Abbreviated Name')
                            ->withSyncMeta(),
                    ])->columns(2)
                    ->columnSpanFull(),

                Section::make('Credits & Hours')
                    ->schema([
                        TextEntry::make('credits')
                            ->label('Total Credits')
                            ->withSyncMeta(),
                        TextEntry::make('l_credit')
                            ->label('Lecture Support Credits')
                            ->withSyncMeta(),
                        TextEntry::make('nl_credit')
                            ->label('Non-Lecture Support Credits')
                            ->withSyncMeta(),
                        TextEntry::make('l_hour')
                            ->label('Lecture Hours')
                            ->withSyncMeta(),
                        TextEntry::make('nl_hour')
                            ->label('Non-Lecture Hours')
                            ->withSyncMeta(),
                        TextEntry::make('s_hour')
                            ->label('Self-Study Hours')
                            ->withSyncMeta(),
                    ])->columns(3)
                    ->columnSpanFull(),

                Section::make('Descriptions')
                    ->schema([
                        TextEntry::make('description_th')
                            ->label('Description (Thai)')
                            ->columnSpanFull()
                            ->withSyncMeta(),
                        TextEntry::make('description_en')
                            ->label('Description (English)')
                            ->columnSpanFull()
                            ->withSyncMeta(),
                    ])->columnSpanFull(),
            ]);
    }
}
