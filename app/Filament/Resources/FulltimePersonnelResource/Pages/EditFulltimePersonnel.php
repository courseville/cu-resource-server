<?php

namespace App\Filament\Resources\FulltimePersonnelResource\Pages;

use App\Filament\Resources\FulltimePersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFulltimePersonnel extends EditRecord
{
    protected static string $resource = FulltimePersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
