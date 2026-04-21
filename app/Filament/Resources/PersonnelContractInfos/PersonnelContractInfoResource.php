<?php

namespace App\Filament\Resources\PersonnelContractInfos;

use App\Filament\Resources\PersonnelContractInfos\Pages\CreatePersonnelContractInfo;
use App\Filament\Resources\PersonnelContractInfos\Pages\EditPersonnelContractInfo;
use App\Filament\Resources\PersonnelContractInfos\Pages\ListPersonnelContractInfos;
use App\Filament\Resources\PersonnelContractInfos\Schemas\PersonnelContractInfoForm;
use App\Filament\Resources\PersonnelContractInfos\Tables\PersonnelContractInfosTable;
use App\Models\Resources\PersonnelContractInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelContractInfoResource extends Resource
{
    protected static ?string $model = PersonnelContractInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'CU Data Gateway';

    protected static ?string $navigationLabel = 'Personnel Contract Info (DG0316)';

    public static function form(Schema $schema): Schema
    {
        return PersonnelContractInfoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelContractInfosTable::configure($table);
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
            'index' => ListPersonnelContractInfos::route('/'),
            'create' => CreatePersonnelContractInfo::route('/create'),
            'edit' => EditPersonnelContractInfo::route('/{record}/edit'),
        ];
    }
}
