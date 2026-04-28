<?php

namespace App\Filament\Resources\PersonnelEducation\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PersonnelEducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('personnel_id'),
                TextInput::make('begin_date'),
                TextInput::make('end_date'),
                TextInput::make('education_level_id'),
                TextInput::make('education_level_name'),
                TextInput::make('institution_id'),
                TextInput::make('institution_name'),
                TextInput::make('major_id'),
                TextInput::make('major_name'),
                TextInput::make('degree_id'),
                TextInput::make('degree_name'),
                TextInput::make('nation_id'),
                TextInput::make('nation_name_th'),
                TextInput::make('distinction_id'),
                TextInput::make('distinction_name'),
                TextInput::make('highest_education'),
                TextInput::make('highest_education_th'),
                TextInput::make('employ_education_id'),
                TextInput::make('employ_education_name'),
                TextInput::make('graduate_date'),
            ]);
    }
}
