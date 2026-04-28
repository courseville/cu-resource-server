<?php

namespace App\Filament\Resources\StudentGraduations\Pages;

use App\Filament\Resources\StudentGraduations\StudentGraduationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStudentGraduation extends EditRecord
{
    protected static string $resource = StudentGraduationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
