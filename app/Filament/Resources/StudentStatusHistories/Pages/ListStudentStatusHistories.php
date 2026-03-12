<?php

namespace App\Filament\Resources\StudentStatusHistories\Pages;

use App\Filament\Exports\StudentStatusHistoryExporter;

use App\Filament\Imports\Resources\StudentStatusHistoryImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use App\Filament\Resources\StudentStatusHistories\StudentStatusHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentStatusHistories extends ListRecords
{
    protected static string $resource = StudentStatusHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(StudentStatusHistoryExporter::class),
            ExcelImportAction::make()
                ->importer(StudentStatusHistoryImporter::class),
CreateAction::make(),
        ];
    }
}
