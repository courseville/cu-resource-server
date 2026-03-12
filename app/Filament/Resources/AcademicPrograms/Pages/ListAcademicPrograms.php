<?php

namespace App\Filament\Resources\AcademicPrograms\Pages;

use App\Filament\Resources\AcademicPrograms\AcademicProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademicPrograms extends ListRecords
{
    protected static string $resource = AcademicProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
