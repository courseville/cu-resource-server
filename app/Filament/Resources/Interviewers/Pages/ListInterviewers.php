<?php

namespace App\Filament\Resources\Interviewers\Pages;

use App\Filament\Exports\Resources\InterviewerExporter;

use App\Filament\Imports\Resources\InterviewerImporter;

use Filament\Actions\ExportAction;

use App\Filament\Actions\ExcelImportAction;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Interviewers\InterviewerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInterviewers extends ListRecords
{
    protected static string $resource = InterviewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(InterviewerExporter::class),
            ExcelImportAction::make()
                ->importer(InterviewerImporter::class),
CreateAction::make(),
        ];
    }
}
