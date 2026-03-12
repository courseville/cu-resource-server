<?php

namespace App\Filament\Resources\Students\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\StudentExporter;
use App\Filament\Imports\Resources\StudentImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_id')
                    ->label('Student ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('first_name_th')
                    ->label('First Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_name_th')
                    ->label('Last Name (TH)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('fac_name')
                    ->label('Faculty')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_acad_year')
                    ->label('Year')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(StudentImporter::class),
                ExportAction::make()
                    ->exporter(StudentExporter::class),
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
