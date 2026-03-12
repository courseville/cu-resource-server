<?php

namespace App\Filament\Resources\StudentAdmissions\Pages;

use App\Filament\Exports\StudentAdmissionExporter;

use App\Filament\Imports\Resources\StudentAdmissionImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use App\Filament\Resources\StudentAdmissions\StudentAdmissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentAdmissions extends ListRecords
{
    protected static string $resource = StudentAdmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(StudentAdmissionExporter::class),
            ExcelImportAction::make()
                ->importer(StudentAdmissionImporter::class),
CreateAction::make(),
        ];
    }
}
