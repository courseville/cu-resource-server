<?php

namespace App\Filament\Resources\StudentGrades\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Exports\StudentGradeExporter;
use Filament\Tables\Table;

class StudentGradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_code')
                    ->searchable(),
                TextColumn::make('year')
                    ->searchable(),
                TextColumn::make('semester')
                    ->searchable(),
                TextColumn::make('course_code')
                    ->searchable(),
                TextColumn::make('total_credit')
                    ->searchable(),
                TextColumn::make('grade')
                    ->searchable(),
                TextColumn::make('last_update')
                    ->searchable(),
                TextColumn::make('faccode')
                    ->searchable(),
                TextColumn::make('depcode')
                    ->searchable(),
                TextColumn::make('majorcode')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(StudentGradeExporter::class),
                ]),
            ]);
    }
}
