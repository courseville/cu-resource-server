<?php

namespace App\Filament\Resources\CourseSchedules\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseScheduleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Schedule Identification')
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
                    ])->columns(2),

                Section::make('Section Details')
                    ->schema([
                        TextEntry::make('section')
                            ->label('Section')
                            ->withSyncMeta(),
                        TextEntry::make('row_seq')
                            ->label('Row Seq')
                            ->withSyncMeta(),
                        TextEntry::make('teach_type')
                            ->label('Teach Type')
                            ->withSyncMeta(),
                    ])->columns(3),

                Section::make('Time & Day')
                    ->schema([
                        TextEntry::make('daycode')
                            ->label('Day Code')
                            ->withSyncMeta(),
                        TextEntry::make('teach_time_from')
                            ->label('Time From')
                            ->withSyncMeta(),
                        TextEntry::make('teach_time_to')
                            ->label('Time To')
                            ->withSyncMeta(),
                    ])->columns(3),

                Section::make('Institutional Hierarchy')
                    ->schema([
                        TextEntry::make('faccode')
                            ->label('Faculty Code')
                            ->withSyncMeta(),
                    ])->columns(2),
            ]);
    }
}
