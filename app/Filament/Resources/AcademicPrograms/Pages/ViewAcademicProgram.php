<?php

namespace App\Filament\Resources\AcademicPrograms\Pages;

use App\Filament\Resources\AcademicPrograms\AcademicProgramResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAcademicProgram extends ViewRecord
{
    protected static string $resource = AcademicProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
