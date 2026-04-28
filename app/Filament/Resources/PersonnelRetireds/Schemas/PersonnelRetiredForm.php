<?php

namespace App\Filament\Resources\PersonnelRetireds\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PersonnelRetiredForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('personnel_id'),
                TextInput::make('begin_date'),
                TextInput::make('end_date'),
                TextInput::make('status_id'),
                TextInput::make('title_th'),
                TextInput::make('name_th'),
                TextInput::make('surname_th'),
                TextInput::make('title_en'),
                TextInput::make('name_en'),
                TextInput::make('surname_en'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('nation'),
                TextInput::make('citizen_id'),
                TextInput::make('passport_number'),
                TextInput::make('staff_group'),
                TextInput::make('personnel_grp_id'),
                TextInput::make('personnel_grp_name'),
                TextInput::make('personnel_subgrp_name'),
                TextInput::make('position_name'),
                TextInput::make('position_number'),
                TextInput::make('btrtl'),
                TextInput::make('btrtl_text'),
                TextInput::make('stell')
                    ->tel(),
                TextInput::make('stell_text')
                    ->tel(),
                TextInput::make('ansvh'),
                TextInput::make('ansvh_text'),
                TextInput::make('structure_level1_name'),
                TextInput::make('structure_level2_name'),
                TextInput::make('structure_level3_name'),
                TextInput::make('structure_level4_name'),
            ]);
    }
}
