<?php

namespace App\Filament\Resources\ProgramCommittees\Pages;

use App\Filament\Resources\ProgramCommittees\ProgramCommitteeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProgramCommittee extends ViewRecord
{
    protected static string $resource = ProgramCommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
