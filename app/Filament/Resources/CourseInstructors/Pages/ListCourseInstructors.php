<?php

namespace App\Filament\Resources\CourseInstructors\Pages;

use App\Filament\Resources\CourseInstructors\CourseInstructorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseInstructors extends ListRecords
{
    protected static string $resource = CourseInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
