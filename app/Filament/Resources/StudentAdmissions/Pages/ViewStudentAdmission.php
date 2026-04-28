<?php

namespace App\Filament\Resources\StudentAdmissions\Pages;

use App\Filament\Resources\StudentAdmissions\StudentAdmissionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentAdmission extends ViewRecord
{
    protected static string $resource = StudentAdmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
