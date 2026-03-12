<?php

namespace App\Filament\Resources\StudentGraduations\Pages;

use App\Filament\Resources\StudentGraduations\StudentGraduationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentGraduations extends ListRecords
{
    protected static string $resource = StudentGraduationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
