<?php

namespace App\Filament\Resources\Majors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MajorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Major Information')
                    ->schema([
                        TextEntry::make('majorcode')
                            ->label('Major Code'),
                        TextEntry::make('name_th')
                            ->label('Name (TH)'),
                        TextEntry::make('name_en')
                            ->label('Name (EN)'),
                    ])->columns(2),
            ]);
    }
}
