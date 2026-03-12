<?php

namespace App\Filament\Resources\ProgramCommittees\Pages;

use App\Filament\Resources\ProgramCommittees\ProgramCommitteeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramCommittee extends EditRecord
{
    protected static string $resource = ProgramCommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
