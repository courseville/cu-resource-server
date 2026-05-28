<?php

namespace App\Filament\Resources\DataConflicts\Tables;

use App\Models\DataConflict;
use App\Models\PkModel;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DataConflictsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model_class')
                    ->label('Resource')
                    ->formatStateUsing(fn (string $state): string => str(class_basename($state))->headline())
                    ->sortable()
                    ->searchable(),
                TextColumn::make('model_pk_value')
                    ->label('PK')
                    ->searchable(),
                TextColumn::make('dataSource.name')
                    ->label('Source')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'resolved_incoming' => 'success',
                        'resolved_current' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('resolvedBy.name')
                    ->label('Resolved By')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('resolved_at')
                    ->label('Resolved At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                // Action::make('accept_incoming')
                //     ->label('Accept Incoming')
                //     ->color('success')
                //     ->icon('heroicon-o-check')
                //     ->visible(fn (DataConflict $record) => $record->status === 'pending')
                //     ->action(function (DataConflict $record) {
                //         $modelClass = $record->model_class;
                //         $pkValue = $record->model_pk_value;
                //         $incomingData = $record->incoming_data;

                //         $pkModel = PkModel::where('model', $modelClass)->first();
                //         $pkColumns = explode(',', $pkModel ? $pkModel->primary_key : 'id');
                //         $pkValues = explode('|', $pkValue);

                //         $search = array_combine(array_map('trim', $pkColumns), $pkValues);

                //         $modelClass::updateOrCreate($search, $incomingData);

                //         $record->update([
                //             'status' => 'resolved_incoming',
                //             'resolved_by' => Auth::id(),
                //             'resolved_at' => now(),
                //         ]);
                //     })
                //     ->requiresConfirmation(),
                // Action::make('keep_current')
                //     ->label('Keep Current')
                //     ->color('gray')
                //     ->icon('heroicon-o-x-mark')
                //     ->visible(fn (DataConflict $record) => $record->status === 'pending')
                //     ->action(function (DataConflict $record) {
                //         $record->update([
                //             'status' => 'resolved_current',
                //             'resolved_by' => Auth::id(),
                //             'resolved_at' => now(),
                //         ]);
                //     })
                //     ->requiresConfirmation(),
            ]);
    }
}
