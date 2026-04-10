<?php

namespace App\Filament\Resources\PersonnelRetireds;

use App\Filament\Resources\PersonnelRetireds\Pages\CreatePersonnelRetired;
use App\Filament\Resources\PersonnelRetireds\Pages\EditPersonnelRetired;
use App\Filament\Resources\PersonnelRetireds\Pages\ListPersonnelRetireds;
use App\Filament\Resources\PersonnelRetireds\Schemas\PersonnelRetiredForm;
use App\Filament\Resources\PersonnelRetireds\Tables\PersonnelRetiredsTable;
use App\Models\Resources\PersonnelRetired;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelRetiredResource extends Resource
{
    protected static ?string $model = PersonnelRetired::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PersonnelRetiredForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelRetiredsTable::configure($table);
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
            'index' => ListPersonnelRetireds::route('/'),
            'create' => CreatePersonnelRetired::route('/create'),
            'edit' => EditPersonnelRetired::route('/{record}/edit'),
        ];
    }
}
