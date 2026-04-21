<?php

namespace App\Filament\Resources\PersonnelPositions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ExportBulkAction;
use App\Filament\Exports\PersonnelPositionExporter;
use Filament\Tables\Table;

class PersonnelPositionsTable
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
                TextColumn::make('positiontype_id')
                    ->searchable(),
                TextColumn::make('positiontype_name')
                    ->searchable(),
                TextColumn::make('positiontype_text')
                    ->searchable(),
                TextColumn::make('fieldstudy')
                    ->searchable(),
                TextColumn::make('subdiscipline_1')
                    ->searchable(),
                TextColumn::make('subdiscipline_2')
                    ->searchable(),
                TextColumn::make('subdiscipline_3')
                    ->searchable(),
                TextColumn::make('subdiscipline_4')
                    ->searchable(),
                TextColumn::make('subdiscipline_5')
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
                        ->exporter(PersonnelPositionExporter::class),
                ]),
            ]);
    }
}
