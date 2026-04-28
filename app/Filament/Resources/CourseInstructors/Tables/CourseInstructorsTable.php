<?php

namespace App\Filament\Resources\CourseInstructors\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CourseInstructorExporter;
use App\Filament\Imports\Resources\CourseInstructorImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
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
                TextColumn::make('acad_year')
                    ->label('Year')
                    ->sortable(),
                // TextColumn::make('instructor_no')
                //     ->label('Instructor No.')
                //     ->sortable()
                //     ->searchable(),
                TextColumn::make('position')
                    ->label('Position')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_thai')
                    ->label('Instructor Name (Thai)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('surname_thai')
                    ->label('Instructor Surname (Thai)')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ExcelImportAction::make()
                //     ->importer(CourseInstructorImporter::class),
                // ExportAction::make()
                //     ->exporter(CourseInstructorExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(CourseInstructorExporter::class),
                ]),
            ]);
    }
}
