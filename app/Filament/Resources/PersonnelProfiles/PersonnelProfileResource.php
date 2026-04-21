<?php

namespace App\Filament\Resources\PersonnelProfiles;

use App\Filament\Resources\PersonnelProfiles\Pages\CreatePersonnelProfile;
use App\Filament\Resources\PersonnelProfiles\Pages\EditPersonnelProfile;
use App\Filament\Resources\PersonnelProfiles\Pages\ListPersonnelProfiles;
use App\Filament\Resources\PersonnelProfiles\Schemas\PersonnelProfileForm;
use App\Filament\Resources\PersonnelProfiles\Tables\PersonnelProfilesTable;
use App\Models\Resources\PersonnelProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelProfileResource extends Resource
{
    protected static ?string $model = PersonnelProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'CU Data Gateway';

    protected static ?string $navigationLabel = 'Personnel Profile (DG0303)';

    public static function form(Schema $schema): Schema
    {
        return PersonnelProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelProfilesTable::configure($table);
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
            'index' => ListPersonnelProfiles::route('/'),
            'create' => CreatePersonnelProfile::route('/create'),
            'edit' => EditPersonnelProfile::route('/{record}/edit'),
        ];
    }
}
