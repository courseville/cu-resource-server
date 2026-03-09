<?php

namespace App\Filament\Resources\Interviewers\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Interviewers\InterviewerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInterviewer extends EditRecord
{
    protected static string $resource = InterviewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
