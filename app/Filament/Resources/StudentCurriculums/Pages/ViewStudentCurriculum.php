<?php

namespace App\Filament\Resources\StudentCurriculums\Pages;

use App\Filament\Resources\StudentCurriculums\StudentCurriculumResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentCurriculum extends ViewRecord
{
    protected static string $resource = StudentCurriculumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
