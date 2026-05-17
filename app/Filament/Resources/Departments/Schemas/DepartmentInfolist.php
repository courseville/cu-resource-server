<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepartmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Department Information')
                    ->schema([
                        TextEntry::make('depcode')
                            ->label('Department Code'),
                        TextEntry::make('name_th')
                            ->label('Name (Thai)'),
                        TextEntry::make('name_en')
                            ->label('Name (English)'),
                    ])->columns(2),
            ]);
    }
}
