<?php

namespace App\Filament\Resources\StudentCurriculums\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\StudentCurriculumExporter;
use App\Filament\Imports\Resources\StudentCurriculumImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentCurriculumsTable
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
                TextColumn::make('course_code')
                    ->label('Course')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('grade')
                    ->label('Grade')
                    ->sortable(),
                TextColumn::make('year')
                    ->label('Year')
                    ->sortable(),
                TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(StudentCurriculumImporter::class),
                ExportAction::make()
                    ->exporter(StudentCurriculumExporter::class),
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
