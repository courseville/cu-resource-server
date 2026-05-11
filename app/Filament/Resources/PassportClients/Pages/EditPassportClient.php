<?php

namespace App\Filament\Resources\PassportClients\Pages;

use App\Filament\Resources\PassportClients\PassportClientResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditPassportClient extends EditRecord
{
    protected static string $resource = PassportClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('regenerateSecret')
                ->label('Regenerate Secret')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Regenerate client secret?')
                ->modalDescription('Applications using the current secret will stop working until they are updated with the new secret.')
                ->action(function (): void {
                    $this->record->secret = Str::random(40);
                    $this->record->save();

                    Notification::make()
                        ->title('Client secret regenerated')
                        ->body("Copy this secret now — it will not be shown again:\n\n{$this->record->plainSecret}")
                        ->success()
                        ->persistent()
                        ->send();
                }),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        PassportClientResource::syncPersonalAccessClient($this->record);
    }
}
