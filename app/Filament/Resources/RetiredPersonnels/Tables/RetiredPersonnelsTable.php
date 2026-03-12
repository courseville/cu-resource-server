<?php

namespace App\Filament\Resources\RetiredPersonnels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RetiredPersonnelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('personnel_id')
                    ->label('Personnel ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('personnel.first_name_th')
                    ->label('First Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('personnel.last_name_th')
                    ->label('Last Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('retired_id')
                    ->label('Retired ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('retirement_date')
                    ->label('Retirement Date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
