<?php

namespace App\Filament\Resources\CourseSchedules\Pages;

use App\Filament\Resources\CourseSchedules\CourseScheduleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseSchedule extends ViewRecord
{
    protected static string $resource = CourseScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
