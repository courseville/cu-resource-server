<?php

namespace App\Filament\Resources\TestProfileResource\Pages;

use App\Filament\Resources\TestProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestProfile extends CreateRecord
{
    protected static string $resource = TestProfileResource::class;
}
