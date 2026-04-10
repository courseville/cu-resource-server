<?php

namespace App\Filament\Resources\PersonnelProfiles\Pages;

use App\Filament\Resources\PersonnelProfiles\PersonnelProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonnelProfile extends CreateRecord
{
    protected static string $resource = PersonnelProfileResource::class;
}
