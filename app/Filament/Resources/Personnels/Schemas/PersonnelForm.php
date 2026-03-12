<?php

namespace App\Filament\Resources\Personnels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;

class PersonnelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextInput::make('personnel_id')
                            ->label('Personnel ID')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('title_th')
                            ->label('Title (TH)')
                            ->maxLength(255),
                        TextInput::make('first_name_th')
                            ->label('First Name (TH)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name_th')
                            ->label('Last Name (TH)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->maxLength(255),
                        TextInput::make('first_name_en')
                            ->label('First Name (EN)')
                            ->maxLength(255),
                        TextInput::make('last_name_en')
                            ->label('Last Name (EN)')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('public_email')
                            ->label('Public Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('private_email')
                            ->label('Private Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone_no')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Addresses')
                    ->schema([
                        Textarea::make('current_address')
                            ->label('Current Address')
                            ->columnSpanFull(),
                        TextInput::make('current_sub_district')
                            ->label('Sub-district'),
                        TextInput::make('current_district')
                            ->label('District'),
                        TextInput::make('current_province')
                            ->label('Province'),
                    ])->columns(3),
            ]);
    }
}
