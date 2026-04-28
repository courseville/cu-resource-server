<?php

namespace App\Filament\Resources\ScholarshipApplications\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\Resources\ScholarshipApplicationExporter;
use App\Filament\Imports\Resources\ScholarshipApplicationImporter;
use App\Filament\Resources\ScholarshipApplications\ScholarshipApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListScholarshipApplications extends ListRecords
{
    protected static string $resource = ScholarshipApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(ScholarshipApplicationExporter::class),
            ExcelImportAction::make()
                ->importer(ScholarshipApplicationImporter::class),
            CreateAction::make(),
        ];
    }
}
