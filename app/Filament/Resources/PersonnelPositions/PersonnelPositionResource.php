<?php

namespace App\Filament\Resources\PersonnelPositions;

use App\Filament\Resources\PersonnelPositions\Pages\CreatePersonnelPosition;
use App\Filament\Resources\PersonnelPositions\Pages\EditPersonnelPosition;
use App\Filament\Resources\PersonnelPositions\Pages\ListPersonnelPositions;
use App\Filament\Resources\PersonnelPositions\Schemas\PersonnelPositionForm;
use App\Filament\Resources\PersonnelPositions\Tables\PersonnelPositionsTable;
use App\Models\Resources\PersonnelPosition;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelPositionResource extends Resource
{
    protected static ?string $model = PersonnelPosition::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PersonnelPositionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelPositionsTable::configure($table);
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
            'index' => ListPersonnelPositions::route('/'),
            'create' => CreatePersonnelPosition::route('/create'),
            'edit' => EditPersonnelPosition::route('/{record}/edit'),
        ];
    }
}
