<?php

namespace App\Filament\Resources\DataConflicts\Pages;

use App\Filament\Resources\DataConflictResource;
use App\Models\PkModel;
use App\Models\DataConflict;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;

class ViewDataConflict extends ViewRecord
{
    protected static string $resource = DataConflictResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('accept_incoming')
                ->label('Accept Incoming')
                ->color('success')
                ->icon('heroicon-o-check')
                ->visible(fn () => $this->getRecord()->status === 'pending')
                ->action(function () {
                    $record = $this->getRecord();
                    $modelClass = $record->model_class;
                    $pkValue = $record->model_pk_value;
                    $incomingData = $record->incoming_data;

                    $pkModel = PkModel::where('model', $modelClass)->first();
                    $pkColumns = explode(',', $pkModel ? $pkModel->primary_key : 'id');
                    $pkValues = explode('|', $pkValue);

                    $search = array_combine(array_map('trim', $pkColumns), $pkValues);

                    $modelClass::updateOrCreate($search, $incomingData);

                    $record->update([
                        'status' => 'resolved_incoming',
                        'resolved_by' => Auth::id(),
                        'resolved_at' => now(),
                    ]);

                    $this->redirect($this->getResource()::getUrl('index'));
                })
                ->requiresConfirmation(),

            Action::make('keep_current')
                ->label('Keep Current')
                ->color('gray')
                ->icon('heroicon-o-x-mark')
                ->visible(fn () => $this->getRecord()->status === 'pending')
                ->action(function () {
                    $record = $this->getRecord();
                    $record->update([
                        'status' => 'resolved_current',
                        'resolved_by' => Auth::id(),
                        'resolved_at' => now(),
                    ]);

                    $this->redirect($this->getResource()::getUrl('index'));
                })
                ->requiresConfirmation(),
        ];
    }
}
