<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CompanyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Company Information')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Company Name'),
                        TextEntry::make('address')
                            ->label('Address')
                            ->columnSpanFull(),
                        TextEntry::make('admin_name')
                            ->label('Admin Name'),
                        TextEntry::make('admin_title')
                            ->label('Admin Title'),
                        TextEntry::make('tel')
                            ->label('Telephone'),
                    ])->columns(2),
            ]);
    }
}
