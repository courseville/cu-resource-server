<?php

namespace App\Filament\Resources\StudentInternships\Tables;

use App\Filament\Exports\StudentInternshipExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentInternshipsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_id')
                    ->label('Student ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('intern_year')
                    ->label('Year')
                    ->sortable(),
                TextColumn::make('company')
                    ->label('Company')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'finish' => 'success',
                        'cancel' => 'danger',
                        default => 'warning',
                    })
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Start')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('End')
                    ->date()
                    ->sortable(),
                // TextColumn::make('prac_score')
                //     ->label('Score')
                //     ->sortable(),
                // TextColumn::make('grade')
                //     ->label('Grade')
                //     ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(StudentInternshipExporter::class),
                ]),
            ]);
    }
}
