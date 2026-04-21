<?php

namespace App\Filament\Resources\PersonnelImages;

use App\Filament\Resources\PersonnelImages\Pages\CreatePersonnelImage;
use App\Filament\Resources\PersonnelImages\Pages\EditPersonnelImage;
use App\Filament\Resources\PersonnelImages\Pages\ListPersonnelImages;
use App\Filament\Resources\PersonnelImages\Schemas\PersonnelImageForm;
use App\Filament\Resources\PersonnelImages\Tables\PersonnelImagesTable;
use App\Models\Resources\PersonnelImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelImageResource extends Resource
{
    protected static ?string $model = PersonnelImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'CU Data Gateway';

    protected static ?string $navigationLabel = 'Personnel Image (DG0307)';

    public static function form(Schema $schema): Schema
    {
        return PersonnelImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelImagesTable::configure($table);
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
            'index' => ListPersonnelImages::route('/'),
            'create' => CreatePersonnelImage::route('/create'),
            'edit' => EditPersonnelImage::route('/{record}/edit'),
        ];
    }
}
