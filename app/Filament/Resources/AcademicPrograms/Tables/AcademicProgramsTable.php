<?php

namespace App\Filament\Resources\AcademicPrograms\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\AcademicProgramExporter;
use App\Filament\Imports\Resources\AcademicProgramImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AcademicProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('oaa_program_id')
                    ->label('OAA Program ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('program_name_th')
                    ->label('Program Name (Thai)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('program_name_en')
                    ->label('Program Name (English)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('degree_name_th')
                    ->label('Degree Name (Thai)')
                    ->sortable(),
                TextColumn::make('faculty_code')
                    ->label('Faculty Code')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ExcelImportAction::make()
                //     ->importer(AcademicProgramImporter::class),
                // ExportAction::make()
                //     ->exporter(AcademicProgramExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(AcademicProgramExporter::class),
                ]),
            ]);
    }
}
