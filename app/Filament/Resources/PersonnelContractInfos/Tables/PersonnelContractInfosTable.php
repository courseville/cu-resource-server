<?php

namespace App\Filament\Resources\PersonnelContractInfos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Exports\PersonnelContractInfoExporter;
use Filament\Tables\Table;

class PersonnelContractInfosTable
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
                TextColumn::make('status_id')
                    ->searchable(),
                TextColumn::make('title_th')
                    ->searchable(),
                TextColumn::make('name_th')
                    ->searchable(),
                TextColumn::make('surname_th')
                    ->searchable(),
                TextColumn::make('title_en')
                    ->searchable(),
                TextColumn::make('name_en')
                    ->searchable(),
                TextColumn::make('surname_en')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('nation')
                    ->searchable(),
                TextColumn::make('citizen_id')
                    ->searchable(),
                TextColumn::make('passport_number')
                    ->searchable(),
                TextColumn::make('staff_group')
                    ->searchable(),
                TextColumn::make('personnel_grp_id')
                    ->searchable(),
                TextColumn::make('personnel_grp_name')
                    ->searchable(),
                TextColumn::make('position_name')
                    ->searchable(),
                TextColumn::make('position_number')
                    ->searchable(),
                TextColumn::make('contract_type_id')
                    ->searchable(),
                TextColumn::make('contract_type_name')
                    ->searchable(),
                TextColumn::make('contract_end_date')
                    ->searchable(),
                TextColumn::make('btrtl')
                    ->searchable(),
                TextColumn::make('btrtl_text')
                    ->searchable(),
                TextColumn::make('stell')
                    ->searchable(),
                TextColumn::make('stell_text')
                    ->searchable(),
                TextColumn::make('organization_id')
                    ->searchable(),
                TextColumn::make('organization_name')
                    ->searchable(),
                TextColumn::make('structure_level1_name')
                    ->searchable(),
                TextColumn::make('structure_level2_name')
                    ->searchable(),
                TextColumn::make('structure_level3_name')
                    ->searchable(),
                TextColumn::make('structure_level4_name')
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
                        ->exporter(PersonnelContractInfoExporter::class),
                ]),
            ]);
    }
}
