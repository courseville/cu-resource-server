<?php

namespace App\Filament\Resources\Companies\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Imports\Resources\CompanyImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Company Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('admin_name')
                    ->label('Admin Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tel')
                    ->label('Telephone')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(CompanyImporter::class),
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
