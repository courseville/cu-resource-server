<?php

namespace App\Filament\Resources\PersonnelActions\Pages;

use App\Filament\Resources\PersonnelActions\PersonnelActionResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonnelAction extends CreateRecord
{
    protected static string $resource = PersonnelActionResource::class;
}
