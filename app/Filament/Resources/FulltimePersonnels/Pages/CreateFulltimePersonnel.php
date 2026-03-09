<?php

namespace App\Filament\Resources\FulltimePersonnels\Pages;

use App\Filament\Resources\FulltimePersonnels\FulltimePersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFulltimePersonnel extends CreateRecord
{
    protected static string $resource = FulltimePersonnelResource::class;
}
