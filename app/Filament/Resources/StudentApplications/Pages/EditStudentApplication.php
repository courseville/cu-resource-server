<?php

namespace App\Filament\Resources\StudentApplications\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\StudentApplications\StudentApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentApplication extends EditRecord
{
    protected static string $resource = StudentApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
