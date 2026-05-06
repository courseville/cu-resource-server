<?php

namespace App\Filament\Resources\StudentAdvisors\Pages;

use App\Filament\Resources\StudentAdvisors\StudentAdvisorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentAdvisors extends ListRecords
{
    protected static string $resource = StudentAdvisorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
