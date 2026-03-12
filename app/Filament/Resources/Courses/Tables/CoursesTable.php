<?php

namespace App\Filament\Resources\Courses\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CourseExporter;
use App\Filament\Imports\Resources\CourseImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course_id')
                    ->label('Course ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_th')
                    ->label('Course Name (Thai)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_en')
                    ->label('Course Name (English)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('credits')
                    ->label('Credits')
                    ->sortable(),
                TextColumn::make('revision_year')
                    ->label('Revision Year')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExcelImportAction::make()
                    ->importer(CourseImporter::class),
                ExportAction::make()
                    ->exporter(CourseExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(CourseExporter::class),
                ]),
            ]);
    }
}
