<?php

namespace App\Filament\Resources\Majors\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Imports\Resources\MajorImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MajorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('majorcode')
                    ->label('Major Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_th')
                    ->label('Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_en')
                    ->label('Name (EN)')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(MajorImporter::class),
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
