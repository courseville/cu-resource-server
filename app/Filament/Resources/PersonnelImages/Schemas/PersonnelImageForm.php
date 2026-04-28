<?php

namespace App\Filament\Resources\PersonnelImages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PersonnelImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('personnel_id'),
                TextInput::make('citizen_id'),
                TextInput::make('passport_number'),
                FileUpload::make('image_name')
                    ->image(),
                TextInput::make('begin_date'),
            ]);
    }
}
