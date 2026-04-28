<?php

namespace App\Filament\Resources\Curriculums\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\CurriculumExporter;
use App\Filament\Imports\Resources\CurriculumImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CurriculumsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course_code_no')
                    ->label('Course Code No.')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('major')
                    ->label('Major')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('degree')
                    ->label('Degree')
                    ->sortable(),
                TextColumn::make('begin_year')
                    ->label('Begin Year')
                    ->sortable(),
                TextColumn::make('faccode')
                    ->label('Faculty Code')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ExcelImportAction::make()
                //     ->importer(CurriculumImporter::class),
                // ExportAction::make()
                //     ->exporter(CurriculumExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(CurriculumExporter::class),
                ]),
            ]);
    }
}
