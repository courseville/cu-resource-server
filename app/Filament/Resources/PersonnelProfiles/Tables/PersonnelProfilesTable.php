<?php

namespace App\Filament\Resources\PersonnelProfiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Exports\PersonnelProfileExporter;
use Filament\Tables\Table;

class PersonnelProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('personnel_id')
                    ->searchable(),
                TextColumn::make('begin_date')
                    ->searchable(),
                TextColumn::make('end_date')
                    ->searchable(),
                TextColumn::make('title_id')
                    ->searchable(),
                TextColumn::make('title_th')
                    ->searchable(),
                TextColumn::make('name_th')
                    ->searchable(),
                TextColumn::make('surname_th')
                    ->searchable(),
                TextColumn::make('gender')
                    ->searchable(),
                TextColumn::make('birth_date')
                    ->searchable(),
                TextColumn::make('rank_title')
                    ->searchable(),
                TextColumn::make('doctoral_title')
                    ->searchable(),
                TextColumn::make('acad_title_1')
                    ->searchable(),
                TextColumn::make('acad_title_2')
                    ->searchable(),
                TextColumn::make('title_by_the_king')
                    ->searchable(),
                TextColumn::make('nation')
                    ->searchable(),
                TextColumn::make('marrital_status')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('title_en')
                    ->searchable(),
                TextColumn::make('name_en')
                    ->searchable(),
                TextColumn::make('surname_en')
                    ->searchable(),
                TextColumn::make('citizen_id')
                    ->searchable(),
                TextColumn::make('passport_number')
                    ->searchable(),
                TextColumn::make('office_phonenumber')
                    ->searchable(),
                TextColumn::make('full_title')
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
                        ->exporter(PersonnelProfileExporter::class),
                ]),
            ]);
    }
}
