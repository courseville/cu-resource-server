<?php

namespace App\Filament\Resources\StudentGraduations\Pages;

use App\Filament\Resources\StudentGraduations\StudentGraduationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentGraduation extends ViewRecord
{
    protected static string $resource = StudentGraduationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
