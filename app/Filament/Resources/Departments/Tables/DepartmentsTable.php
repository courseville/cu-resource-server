<?php

namespace App\Filament\Resources\Departments\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Imports\Resources\DepartmentImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DepartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('depcode')
                    ->label('Department Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_th')
                    ->label('Name (Thai)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_en')
                    ->label('Name (English)')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(DepartmentImporter::class),
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
