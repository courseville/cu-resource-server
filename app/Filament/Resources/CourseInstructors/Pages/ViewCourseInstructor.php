<?php

namespace App\Filament\Resources\CourseInstructors\Pages;

use App\Filament\Resources\CourseInstructors\CourseInstructorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseInstructor extends ViewRecord
{
    protected static string $resource = CourseInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
