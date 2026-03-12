<?php

namespace App\Filament\Resources\CourseInstructors\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CourseInstructorExporter;
use App\Filament\Imports\Resources\CourseInstructorImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseInstructorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course_code')
                    ->label('Course Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('instructor_no')
                    ->label('Instructor No.')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('instructor_name')
                    ->label('Instructor Name (Thai)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('acad_year')
                    ->label('Year')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(CourseInstructorImporter::class),
                ExportAction::make()
                    ->exporter(CourseInstructorExporter::class),
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
