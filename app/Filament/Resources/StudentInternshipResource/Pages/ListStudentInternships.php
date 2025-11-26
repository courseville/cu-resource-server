<?php

namespace App\Filament\Resources\StudentInternshipResource\Pages;

use App\Filament\Resources\StudentInternshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentInternships extends ListRecords
{
    protected static string $resource = StudentInternshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
