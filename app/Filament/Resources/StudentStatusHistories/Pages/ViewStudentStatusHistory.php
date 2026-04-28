<?php

namespace App\Filament\Resources\StudentStatusHistories\Pages;

use App\Filament\Resources\StudentStatusHistories\StudentStatusHistoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentStatusHistory extends ViewRecord
{
    protected static string $resource = StudentStatusHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
