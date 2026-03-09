<?php

namespace App\Filament\Resources\Interviewers\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Interviewers\InterviewerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInterviewers extends ListRecords
{
    protected static string $resource = InterviewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
