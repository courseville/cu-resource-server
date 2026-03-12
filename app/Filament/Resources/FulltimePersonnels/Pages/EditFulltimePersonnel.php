<?php

namespace App\Filament\Resources\FulltimePersonnels\Pages;

use App\Filament\Resources\FulltimePersonnels\FulltimePersonnelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFulltimePersonnel extends EditRecord
{
    protected static string $resource = FulltimePersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
