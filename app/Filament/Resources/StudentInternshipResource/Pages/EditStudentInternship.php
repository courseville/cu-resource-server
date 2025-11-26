<?php

namespace App\Filament\Resources\StudentInternshipResource\Pages;

use App\Filament\Resources\StudentInternshipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentInternship extends EditRecord
{
    protected static string $resource = StudentInternshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
