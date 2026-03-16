<?php

namespace App\Filament\Resources\ProgramCommittees\Tables;

use App\Filament\Actions\ExcelImportAction;
use App\Filament\Exports\ProgramCommitteeExporter;
use App\Filament\Imports\Resources\ProgramCommitteeImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProgramCommitteesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('program_no')
                    ->label('Program No.')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('personal_id')
                    ->label('Personal ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('committee_tag')
                    ->label('Tag')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('active_year')
                    ->label('Active Year')
                    ->sortable(),
                TextColumn::make('effective_date')
                    ->label('Effective Date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ExcelImportAction::make()
                //     ->importer(ProgramCommitteeImporter::class),
                // ExportAction::make()
                //     ->exporter(ProgramCommitteeExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(ProgramCommitteeExporter::class),
                ]),
            ]);
    }
}
