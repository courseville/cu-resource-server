<?php

namespace App\Filament\Resources\ContractPersonnels;

use App\Filament\Resources\ContractPersonnels\Pages\CreateContractPersonnel;
use App\Filament\Resources\ContractPersonnels\Pages\EditContractPersonnel;
use App\Filament\Resources\ContractPersonnels\Pages\ListContractPersonnels;
use App\Filament\Resources\ContractPersonnels\Pages\ViewContractPersonnel;
use App\Filament\Resources\ContractPersonnels\Schemas\ContractPersonnelForm;
use App\Filament\Resources\ContractPersonnels\Tables\ContractPersonnelsTable;
use App\Models\Resources\ContractPersonnel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContractPersonnelResource extends Resource
{
    protected static ?string $model = ContractPersonnel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|\UnitEnum|null $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Contract';

    public static function form(Schema $schema): Schema
    {
        return ContractPersonnelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContractPersonnelsTable::configure($table);
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
            'index' => ListContractPersonnels::route('/'),
            'create' => CreateContractPersonnel::route('/create'),
            'view' => ViewContractPersonnel::route('/{record}'),
            'edit' => EditContractPersonnel::route('/{record}/edit'),
        ];
    }
}
