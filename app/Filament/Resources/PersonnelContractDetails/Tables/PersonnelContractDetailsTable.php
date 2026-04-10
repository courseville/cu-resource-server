<?php

namespace App\Filament\Resources\PersonnelContractDetails\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Exports\PersonnelContractDetailExporter;
use Filament\Tables\Table;

class PersonnelContractDetailsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('personnel_id')
                    ->searchable(),
                TextColumn::make('begin_date')
                    ->searchable(),
                TextColumn::make('end_date')
                    ->searchable(),
                TextColumn::make('contract_type_id')
                    ->searchable(),
                TextColumn::make('contract_type_name')
                    ->searchable(),
                TextColumn::make('probation')
                    ->searchable(),
                TextColumn::make('probation_unit')
                    ->searchable(),
                TextColumn::make('contract_end_date')
                    ->searchable(),
                TextColumn::make('disemploy_employer')
                    ->searchable(),
                TextColumn::make('disemploy_employee')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(PersonnelContractDetailExporter::class),
                ]),
            ]);
    }
}
