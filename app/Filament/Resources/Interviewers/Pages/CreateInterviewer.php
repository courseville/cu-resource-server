<?php

namespace App\Filament\Resources\Interviewers\Pages;

use App\Filament\Resources\Interviewers\InterviewerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInterviewer extends CreateRecord
{
    protected static string $resource = InterviewerResource::class;
}
