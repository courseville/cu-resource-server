<?php

namespace App\Filament\Resources\ScholarshipApplications\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\ScholarshipApplications\ScholarshipApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScholarshipApplications extends ListRecords
{
    protected static string $resource = ScholarshipApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
