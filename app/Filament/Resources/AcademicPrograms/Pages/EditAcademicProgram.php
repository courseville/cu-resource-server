<?php

namespace App\Filament\Resources\AcademicPrograms\Pages;

use App\Filament\Resources\AcademicPrograms\AcademicProgramResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademicProgram extends EditRecord
{
    protected static string $resource = AcademicProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
