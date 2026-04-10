<?php

namespace App\Filament\Resources\PersonnelContractDetails;

use App\Filament\Resources\PersonnelContractDetails\Pages\CreatePersonnelContractDetail;
use App\Filament\Resources\PersonnelContractDetails\Pages\EditPersonnelContractDetail;
use App\Filament\Resources\PersonnelContractDetails\Pages\ListPersonnelContractDetails;
use App\Filament\Resources\PersonnelContractDetails\Schemas\PersonnelContractDetailForm;
use App\Filament\Resources\PersonnelContractDetails\Tables\PersonnelContractDetailsTable;
use App\Models\Resources\PersonnelContractDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelContractDetailResource extends Resource
{
    protected static ?string $model = PersonnelContractDetail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PersonnelContractDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelContractDetailsTable::configure($table);
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
            'index' => ListPersonnelContractDetails::route('/'),
            'create' => CreatePersonnelContractDetail::route('/create'),
            'edit' => EditPersonnelContractDetail::route('/{record}/edit'),
        ];
    }
}
