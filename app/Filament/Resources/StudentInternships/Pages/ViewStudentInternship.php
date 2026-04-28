<?php

namespace App\Filament\Resources\StudentInternships\Pages;

use App\Filament\Resources\StudentInternships\StudentInternshipResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentInternship extends ViewRecord
{
    protected static string $resource = StudentInternshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
