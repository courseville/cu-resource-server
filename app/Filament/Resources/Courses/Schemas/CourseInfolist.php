<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class CourseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Identification')
                    ->schema([
                        TextEntry::make('course_id')
                            ->label('Course ID'),
                        TextEntry::make('course_no')
                            ->label('Course No.'),
                        TextEntry::make('program_id')
                            ->label('Program ID'),
                        TextEntry::make('revision_year')
                            ->label('Revision Year'),
                    ])->columns(2),

                Section::make('Course Names')
                    ->schema([
                        TextEntry::make('name_th')
                            ->label('Course Name (Thai)'),
                        TextEntry::make('name_en')
                            ->label('Course Name (English)'),
                        TextEntry::make('name_abbr')
                            ->label('Abbreviated Name'),
                    ])->columns(2),

                Section::make('Credits & Hours')
                    ->schema([
                        TextEntry::make('credits')
                            ->label('Total Credits'),
                        TextEntry::make('l_credit')
                            ->label('Lecture Support Credits'),
                        TextEntry::make('nl_credit')
                            ->label('Non-Lecture Support Credits'),
                        TextEntry::make('l_hour')
                            ->label('Lecture Hours'),
                        TextEntry::make('nl_hour')
                            ->label('Non-Lecture Hours'),
                        TextEntry::make('s_hour')
                            ->label('Self-Study Hours'),
                    ])->columns(3),

                Section::make('Descriptions')
                    ->schema([
                        TextEntry::make('description_th')
                            ->label('Description (Thai)')
                            ->columnSpanFull(),
                        TextEntry::make('description_en')
                            ->label('Description (English)')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
