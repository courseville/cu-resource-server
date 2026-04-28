<?php

namespace App\Filament\Resources\FulltimePersonnels;

use App\Filament\Resources\FulltimePersonnels\Pages\CreateFulltimePersonnel;
use App\Filament\Resources\FulltimePersonnels\Pages\EditFulltimePersonnel;
use App\Filament\Resources\FulltimePersonnels\Pages\ListFulltimePersonnels;
use App\Filament\Resources\FulltimePersonnels\Pages\ViewFulltimePersonnel;
use App\Filament\Resources\FulltimePersonnels\Schemas\FulltimePersonnelForm;
use App\Filament\Resources\FulltimePersonnels\Tables\FulltimePersonnelsTable;
use App\Models\Resources\FulltimePersonnel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FulltimePersonnelResource extends Resource
{
    protected static ?string $model = FulltimePersonnel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|\UnitEnum|null $navigationGroup = 'Personnel';

    protected static ?string $navigationLabel = 'Fulltime';

    public static function form(Schema $schema): Schema
    {
        return FulltimePersonnelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FulltimePersonnelsTable::configure($table);
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
            'index' => ListFulltimePersonnels::route('/'),
            'create' => CreateFulltimePersonnel::route('/create'),
            'view' => ViewFulltimePersonnel::route('/{record}'),
            'edit' => EditFulltimePersonnel::route('/{record}/edit'),
        ];
    }
}
