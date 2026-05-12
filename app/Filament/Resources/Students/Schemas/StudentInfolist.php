<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextEntry::make('student_id')
                            ->label('Student ID')
                            ->withSyncMeta(),
                        TextEntry::make('full_name_th')
                            ->label('Full Name (Thai)')
                            ->withSyncMeta(),
                        TextEntry::make('full_name_en')
                            ->label('Full Name (English)')
                            ->withSyncMeta(),
                        TextEntry::make('citizen_id')
                            ->label('Citizen ID')
                            ->withSyncMeta(),
                        TextEntry::make('birth')
                            ->date()
                            ->withSyncMeta(),
                    ])->columns(2),

                Section::make('Enrollment & Academic Information')
                    ->schema([
                        TextEntry::make('fac_name')
                            ->label('Faculty')
                            ->withSyncMeta(),
                        TextEntry::make('dep_name')
                            ->label('Department')
                            ->withSyncMeta(),
                        TextEntry::make('major_name')
                            ->label('Major')
                            ->withSyncMeta(),
                        TextEntry::make('start_acad_year')
                            ->label('Start Year')
                            ->withSyncMeta(),
                        TextEntry::make('credit_tot')
                            ->label('Total Credits')
                            ->withSyncMeta(),
                    ])->columns(2),
            ]);
    }
}
