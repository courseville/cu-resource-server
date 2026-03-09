<?php

namespace App\Filament\Resources\StudentInternships\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\StudentInternships\StudentInternshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentInternships extends ListRecords
{
    protected static string $resource = StudentInternshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
