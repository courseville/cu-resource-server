<?php

namespace App\Filament\Resources\Personnels\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class PersonnelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextEntry::make('personnel_id')
                            ->label('Personnel ID'),
                        TextEntry::make('first_name_th')
                            ->label('First Name (Thai)'),
                        TextEntry::make('last_name_th')
                            ->label('Last Name (Thai)'),
                        TextEntry::make('public_email')
                            ->label('Email'),
                    ])->columns(2),
            ]);
    }
}
