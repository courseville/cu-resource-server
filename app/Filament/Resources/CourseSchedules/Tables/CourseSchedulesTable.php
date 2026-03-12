<?php

namespace App\Filament\Resources\CourseSchedules\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CourseScheduleExporter;
use App\Filament\Imports\Resources\CourseScheduleImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseSchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course_code')
                    ->label('Course Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Year')
                    ->sortable(),
                TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable(),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('daycode')
                    ->label('Day')
                    ->sortable(),
                TextColumn::make('teach_time_from')
                    ->label('From'),
                TextColumn::make('teach_time_to')
                    ->label('To'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(CourseScheduleImporter::class),
                ExportAction::make()
                    ->exporter(CourseScheduleExporter::class),
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
