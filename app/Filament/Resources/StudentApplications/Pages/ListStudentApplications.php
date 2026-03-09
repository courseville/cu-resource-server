<?php

namespace App\Filament\Resources\StudentApplications\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\StudentApplications\StudentApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentApplications extends ListRecords
{
    protected static string $resource = StudentApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
