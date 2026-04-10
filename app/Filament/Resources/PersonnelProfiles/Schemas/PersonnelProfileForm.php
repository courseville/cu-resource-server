<?php

namespace App\Filament\Resources\PersonnelProfiles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PersonnelProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('personnel_id'),
                TextInput::make('begin_date'),
                TextInput::make('end_date'),
                TextInput::make('title_id'),
                TextInput::make('title_th'),
                TextInput::make('name_th'),
                TextInput::make('surname_th'),
                TextInput::make('gender'),
                TextInput::make('birth_date'),
                TextInput::make('rank_title'),
                TextInput::make('doctoral_title'),
                TextInput::make('acad_title_1'),
                TextInput::make('acad_title_2'),
                TextInput::make('title_by_the_king'),
                TextInput::make('nation'),
                TextInput::make('marrital_status'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('title_en'),
                TextInput::make('name_en'),
                TextInput::make('surname_en'),
                TextInput::make('citizen_id'),
                TextInput::make('passport_number'),
                TextInput::make('office_phonenumber')
                    ->tel(),
                TextInput::make('full_title'),
            ]);
    }
}
