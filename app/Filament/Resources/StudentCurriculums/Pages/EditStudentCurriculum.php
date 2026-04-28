<?php

namespace App\Filament\Resources\StudentCurriculums\Pages;

use App\Filament\Resources\StudentCurriculums\StudentCurriculumResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStudentCurriculum extends EditRecord
{
    protected static string $resource = StudentCurriculumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
