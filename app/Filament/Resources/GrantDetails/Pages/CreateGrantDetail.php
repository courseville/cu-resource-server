<?php

namespace App\Filament\Resources\GrantDetails\Pages;

use App\Filament\Resources\GrantDetails\GrantDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGrantDetail extends CreateRecord
{
    protected static string $resource = GrantDetailResource::class;
}
