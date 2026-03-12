<?php

namespace App\Filament\Resources\StudentApplications\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\Resources\StudentApplicationExporter;
use App\Filament\Imports\Resources\StudentApplicationImporter;
use App\Filament\Resources\StudentApplications\StudentApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentApplications extends ListRecords
{
    protected static string $resource = StudentApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(StudentApplicationExporter::class),
            ExcelImportAction::make()
                ->importer(StudentApplicationImporter::class),
            CreateAction::make(),
        ];
    }
}
