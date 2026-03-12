<?php

namespace App\Filament\Resources\CourseInstructors\Pages;

use App\Filament\Resources\CourseInstructors\CourseInstructorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCourseInstructor extends EditRecord
{
    protected static string $resource = CourseInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
