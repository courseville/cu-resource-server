<?php

namespace App\Filament\Resources\PersonnelResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StructureProfilesRelationManager extends RelationManager
{
    protected static string $relationship = 'structureProfiles';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('structure_level1_id')
                    ->relationship('structureLevel1', 'name')
                    ->label('Structure Level 1')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('structure_level2_id')
                    ->relationship('structureLevel2', 'name')
                    ->label('Structure Level 2')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('structure_level3_id')
                    ->relationship('structureLevel3', 'name')
                    ->label('Structure Level 3')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('structure_level4_id')
                    ->relationship('structureLevel4', 'name')
                    ->label('Structure Level 4')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('structureLevel1.name')
                    ->label('Structure Level 1'),
                Tables\Columns\TextColumn::make('structureLevel2.name')
                    ->label('Structure Level 2'),
                Tables\Columns\TextColumn::make('structureLevel3.name')
                    ->label('Structure Level 3'),
                Tables\Columns\TextColumn::make('structureLevel4.name')
                    ->label('Structure Level 4'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(fn ($record) => 'Edit Structure Profile'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
