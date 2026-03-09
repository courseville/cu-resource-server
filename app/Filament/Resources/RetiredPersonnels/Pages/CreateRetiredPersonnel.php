<?php

namespace App\Filament\Resources\RetiredPersonnels\Pages;

use App\Filament\Resources\RetiredPersonnels\RetiredPersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRetiredPersonnel extends CreateRecord
{
    protected static string $resource = RetiredPersonnelResource::class;
}
