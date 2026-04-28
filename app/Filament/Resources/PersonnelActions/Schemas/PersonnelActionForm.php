<?php

namespace App\Filament\Resources\PersonnelActions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PersonnelActionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('personnel_id'),
                TextInput::make('begin_date'),
                TextInput::make('end_date'),
                TextInput::make('status_id'),
                TextInput::make('status_name'),
                TextInput::make('action_id'),
                TextInput::make('action_name'),
                TextInput::make('reason_id'),
                TextInput::make('reason_name'),
                TextInput::make('modify_user'),
            ]);
    }
}
