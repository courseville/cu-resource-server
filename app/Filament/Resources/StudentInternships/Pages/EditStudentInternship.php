<?php

namespace App\Filament\Resources\StudentInternships\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\StudentInternships\StudentInternshipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentInternship extends EditRecord
{
    protected static string $resource = StudentInternshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
