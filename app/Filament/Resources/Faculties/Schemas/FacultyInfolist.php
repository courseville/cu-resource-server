<?php

namespace App\Filament\Resources\Faculties\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FacultyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Faculty Information')
                    ->schema([
                        TextEntry::make('faccode')
                            ->label('Faculty Code')
                            ->withSyncMeta(),
                        TextEntry::make('name_th')
                            ->label('Name (TH)')
                            ->withSyncMeta(),
                        TextEntry::make('name_en')
                            ->label('Name (EN)')
                            ->withSyncMeta(),
                    ])->columns(2),
            ]);
    }
}
