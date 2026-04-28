<?php

namespace App\Filament\Resources\PersonnelStructures;

use App\Filament\Exports\Resources\StructureExporter;
use App\Filament\Resources\PersonnelStructures\Pages\CreatePersonnelStructure;
use App\Filament\Resources\PersonnelStructures\Pages\EditPersonnelStructure;
use App\Filament\Resources\PersonnelStructures\Pages\ListPersonnelStructures;
use App\Models\Resources\Structure;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PersonnelStructureResource extends Resource
{
    protected static ?string $model = Structure::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('structure_id')
                    ->label('Structure ID')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->label('Name')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('structure_id')
                    ->label('Structure ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(StructureExporter::class),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPersonnelStructures::route('/'),
            'create' => CreatePersonnelStructure::route('/create'),
            'edit' => EditPersonnelStructure::route('/{record}/edit'),
        ];
    }
}
