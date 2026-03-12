<?php

namespace App\Filament\Resources\ScholarshipApplications\Pages;

use App\Filament\Exports\Resources\ScholarshipApplicationExporter;

use App\Filament\Imports\Resources\ScholarshipApplicationImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

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
            ExportAction::make()
                ->exporter(ScholarshipApplicationExporter::class),
            ExcelImportAction::make()
                ->importer(ScholarshipApplicationImporter::class),
CreateAction::make(),
        ];
    }
}
