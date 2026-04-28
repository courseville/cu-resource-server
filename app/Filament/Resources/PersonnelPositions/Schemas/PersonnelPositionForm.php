<?php

namespace App\Filament\Resources\PersonnelPositions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PersonnelPositionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('personnel_id'),
                TextInput::make('begin_date'),
                TextInput::make('end_date'),
                TextInput::make('positiontype_id'),
                TextInput::make('positiontype_name'),
                TextInput::make('positiontype_text'),
                TextInput::make('fieldstudy'),
                TextInput::make('subdiscipline_1'),
                TextInput::make('subdiscipline_2'),
                TextInput::make('subdiscipline_3'),
                TextInput::make('subdiscipline_4'),
                TextInput::make('subdiscipline_5'),
            ]);
    }
}
