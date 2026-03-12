<?php

namespace App\Filament\Resources\StudentGraduations\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\StudentGraduationExporter;
use App\Filament\Imports\Resources\StudentGraduationImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentGraduationsTable
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
                TextColumn::make('acad_year')
                    ->label('Grad Year')
                    ->sortable(),
                TextColumn::make('major_thai')
                    ->label('Major (Thai)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('graduate_date')
                    ->label('Grad Date')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(StudentGraduationImporter::class),
                ExportAction::make()
                    ->exporter(StudentGraduationExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(StudentGraduationExporter::class),
                ]),
            ]);
    }
}
