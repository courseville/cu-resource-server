<?php

namespace App\Filament\Resources\StudentStatusHistories\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\StudentStatusHistoryExporter;
use App\Filament\Imports\Resources\StudentStatusHistoryImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentStatusHistoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_code')
                    ->label('Student Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_thai')
                    ->label('Name (Thai)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('effect_date')
                    ->label('Effect Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('from_acad_year')
                    ->label('Year')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(StudentStatusHistoryImporter::class),
                ExportAction::make()
                    ->exporter(StudentStatusHistoryExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(StudentStatusHistoryExporter::class),
                ]),
            ]);
    }
}
