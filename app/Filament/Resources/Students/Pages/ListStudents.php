<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Exports\StudentExporter;

use App\Filament\Imports\Resources\StudentImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Students\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(StudentExporter::class),
            ExcelImportAction::make()
                ->importer(StudentImporter::class),
CreateAction::make(),
        ];
    }
}
