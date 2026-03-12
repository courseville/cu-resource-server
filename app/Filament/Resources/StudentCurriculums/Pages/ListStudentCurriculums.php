<?php

namespace App\Filament\Resources\StudentCurriculums\Pages;

use App\Filament\Resources\StudentCurriculums\StudentCurriculumResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentCurriculums extends ListRecords
{
    protected static string $resource = StudentCurriculumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
