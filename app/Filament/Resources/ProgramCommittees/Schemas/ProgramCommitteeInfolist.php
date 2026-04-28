<?php

namespace App\Filament\Resources\ProgramCommittees\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProgramCommitteeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Committee Identification')
                    ->schema([
                        TextEntry::make('program_no')
                            ->label('Program No.'),
                        TextEntry::make('active_year')
                            ->label('Active Year'),
                    ])->columns(2),

                Section::make('Committee Details')
                    ->schema([
                        TextEntry::make('committee_tag')
                            ->label('Committee Tag'),
                        TextEntry::make('effective_date')
                            ->label('Effective Date')
                            ->date(),
                        TextEntry::make('personal_id')
                            ->label('Personal ID'),
                    ])->columns(2),
            ]);
    }
}
