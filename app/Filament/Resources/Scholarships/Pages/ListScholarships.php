<?php

namespace App\Filament\Resources\Scholarships\Pages;

use App\Filament\Exports\Resources\ScholarshipExporter;

use App\Filament\Imports\Resources\ScholarshipImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Scholarships\ScholarshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScholarships extends ListRecords
{
    protected static string $resource = ScholarshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(ScholarshipExporter::class),
            ExcelImportAction::make()
                ->importer(ScholarshipImporter::class),
CreateAction::make(),
        ];
    }
}
