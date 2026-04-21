<?php

namespace App\Filament\Resources\PersonnelEducation\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ExportBulkAction;
use App\Filament\Exports\PersonnelEducationExporter;
use Filament\Tables\Table;

class PersonnelEducationTable
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
                TextColumn::make('education_level_id')
                    ->searchable(),
                TextColumn::make('education_level_name')
                    ->searchable(),
                TextColumn::make('institution_id')
                    ->searchable(),
                TextColumn::make('institution_name')
                    ->searchable(),
                TextColumn::make('major_id')
                    ->searchable(),
                TextColumn::make('major_name')
                    ->searchable(),
                TextColumn::make('degree_id')
                    ->searchable(),
                TextColumn::make('degree_name')
                    ->searchable(),
                TextColumn::make('nation_id')
                    ->searchable(),
                TextColumn::make('nation_name_th')
                    ->searchable(),
                TextColumn::make('distinction_id')
                    ->searchable(),
                TextColumn::make('distinction_name')
                    ->searchable(),
                TextColumn::make('highest_education')
                    ->searchable(),
                TextColumn::make('highest_education_th')
                    ->searchable(),
                TextColumn::make('employ_education_id')
                    ->searchable(),
                TextColumn::make('employ_education_name')
                    ->searchable(),
                TextColumn::make('graduate_date')
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
                        ->exporter(PersonnelEducationExporter::class),
                ]),
            ]);
    }
}
