<?php

namespace App\Filament\Resources\CourseSchedules\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class CourseScheduleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Schedule Identification')
                    ->schema([
                        TextEntry::make('year')
                            ->label('Year'),
                        TextEntry::make('semester')
                            ->label('Semester'),
                        TextEntry::make('course_code')
                            ->label('Course Code'),
                        TextEntry::make('course_name')
                            ->label('Course Name'),
                    ])->columns(2),

                Section::make('Section Details')
                    ->schema([
                        TextEntry::make('section')
                            ->label('Section'),
                        TextEntry::make('row_seq')
                            ->label('Row Seq'),
                        TextEntry::make('teach_type')
                            ->label('Teach Type'),
                    ])->columns(3),

                Section::make('Time & Day')
                    ->schema([
                        TextEntry::make('daycode')
                            ->label('Day Code'),
                        TextEntry::make('teach_time_from')
                            ->label('Time From'),
                        TextEntry::make('teach_time_to')
                            ->label('Time To'),
                    ])->columns(3),

                Section::make('Institutional Hierarchy')
                    ->schema([
                        TextEntry::make('faccode')
                            ->label('Faculty Code'),
                    ])->columns(2),
            ]);
    }
}
