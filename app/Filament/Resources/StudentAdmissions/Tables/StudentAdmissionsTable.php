<?php

namespace App\Filament\Resources\StudentAdmissions\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\StudentAdmissionExporter;
use App\Filament\Imports\Resources\StudentAdmissionImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentAdmissionsTable
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
                TextColumn::make('admission_type')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('apply_year')
                    ->label('Year')
                    ->sortable(),
                TextColumn::make('apply_status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(StudentAdmissionImporter::class),
                ExportAction::make()
                    ->exporter(StudentAdmissionExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(StudentAdmissionExporter::class),
                ]),
            ]);
    }
}
