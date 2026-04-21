<?php

namespace App\Filament\Resources\PersonnelGenerals;

use App\Filament\Resources\PersonnelGenerals\Pages\CreatePersonnelGeneral;
use App\Filament\Resources\PersonnelGenerals\Pages\EditPersonnelGeneral;
use App\Filament\Resources\PersonnelGenerals\Pages\ListPersonnelGenerals;
use App\Filament\Resources\PersonnelGenerals\Schemas\PersonnelGeneralForm;
use App\Filament\Resources\PersonnelGenerals\Tables\PersonnelGeneralsTable;
use App\Models\Resources\PersonnelGeneral;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelGeneralResource extends Resource
{
    protected static ?string $model = PersonnelGeneral::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'CU Data Gateway';

    protected static ?string $navigationLabel = 'Personnel General (DG0314)';

    public static function form(Schema $schema): Schema
    {
        return PersonnelGeneralForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelGeneralsTable::configure($table);
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
            'index' => ListPersonnelGenerals::route('/'),
            'create' => CreatePersonnelGeneral::route('/create'),
            'edit' => EditPersonnelGeneral::route('/{record}/edit'),
        ];
    }
}
