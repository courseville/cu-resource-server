<?php

namespace App\Filament\Resources\StudentAdmissions\Pages;

use App\Filament\Resources\StudentAdmissions\StudentAdmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStudentAdmission extends EditRecord
{
    protected static string $resource = StudentAdmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
