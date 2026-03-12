<?php

namespace App\Filament\Resources\StudentAdmissions\Pages;

use App\Filament\Resources\StudentAdmissions\StudentAdmissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentAdmissions extends ListRecords
{
    protected static string $resource = StudentAdmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
