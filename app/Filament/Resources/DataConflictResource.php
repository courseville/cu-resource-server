<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataConflicts\Pages\ListDataConflicts;
use App\Filament\Resources\DataConflicts\Pages\ViewDataConflict;
use App\Filament\Resources\DataConflicts\Schemas\DataConflictForm;
use App\Filament\Resources\DataConflicts\Schemas\DataConflictInfolist;
use App\Filament\Resources\DataConflicts\Tables\DataConflictsTable;
use App\Models\DataConflict;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DataConflictResource extends Resource
{
    protected static ?string $model = DataConflict::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    protected static string|\UnitEnum|null $navigationGroup = 'Data Management';

    protected static ?string $navigationLabel = 'Data Conflicts';

    public static function form(Schema $schema): Schema
    {
        return DataConflictForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DataConflictInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DataConflictsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDataConflicts::route('/'),
            'view' => ViewDataConflict::route('/{record}'),
        ];
    }
}
