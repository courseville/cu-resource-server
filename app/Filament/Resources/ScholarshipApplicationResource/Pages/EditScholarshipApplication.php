<?php

namespace App\Filament\Resources\ScholarshipApplicationResource\Pages;

use App\Filament\Resources\ScholarshipApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScholarshipApplication extends EditRecord
{
    protected static string $resource = ScholarshipApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
