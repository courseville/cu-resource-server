<?php

namespace App\Filament\Resources\Personnels\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StructureProfilesRelationManager extends RelationManager
{
    protected static string $relationship = 'structureProfiles';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('structure_level1_id')
                    ->relationship('structureLevel1', 'name')
                    ->label('Structure Level 1')
                    ->searchable()
                    ->preload(),
                Select::make('structure_level2_id')
                    ->relationship('structureLevel2', 'name')
                    ->label('Structure Level 2')
                    ->searchable()
                    ->preload(),
                Select::make('structure_level3_id')
                    ->relationship('structureLevel3', 'name')
                    ->label('Structure Level 3')
                    ->searchable()
                    ->preload(),
                Select::make('structure_level4_id')
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
                TextColumn::make('structureLevel1.name')
                    ->label('Structure Level 1'),
                TextColumn::make('structureLevel2.name')
                    ->label('Structure Level 2'),
                TextColumn::make('structureLevel3.name')
                    ->label('Structure Level 3'),
                TextColumn::make('structureLevel4.name')
                    ->label('Structure Level 4'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->modalHeading(fn ($record) => 'Edit Structure Profile'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
