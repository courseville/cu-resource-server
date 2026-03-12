<?php

namespace App\Filament\Resources\StudentInternships\Pages;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\StudentInternshipExporter;
use App\Filament\Imports\Resources\StudentInternshipImporter;
use App\Filament\Resources\StudentInternships\StudentInternshipResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentInternships extends ListRecords
{
    protected static string $resource = StudentInternshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(StudentInternshipExporter::class),
            ExcelImportAction::make()
                ->importer(StudentInternshipImporter::class),
            CreateAction::make(),
        ];
    }
}
