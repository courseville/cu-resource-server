<?php

namespace App\Filament\Resources\PersonnelActions;

use App\Filament\Resources\PersonnelActions\Pages\CreatePersonnelAction;
use App\Filament\Resources\PersonnelActions\Pages\EditPersonnelAction;
use App\Filament\Resources\PersonnelActions\Pages\ListPersonnelActions;
use App\Filament\Resources\PersonnelActions\Schemas\PersonnelActionForm;
use App\Filament\Resources\PersonnelActions\Tables\PersonnelActionsTable;
use App\Models\Resources\PersonnelAction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelActionResource extends Resource
{
    protected static ?string $model = PersonnelAction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'CU Data Gateway';

    protected static ?string $navigationLabel = 'Personnel Action (DG0301)';

    public static function form(Schema $schema): Schema
    {
        return PersonnelActionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelActionsTable::configure($table);
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
            'index' => ListPersonnelActions::route('/'),
            'create' => CreatePersonnelAction::route('/create'),
            'edit' => EditPersonnelAction::route('/{record}/edit'),
        ];
    }
}
