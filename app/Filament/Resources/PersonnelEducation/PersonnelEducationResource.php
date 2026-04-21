<?php

namespace App\Filament\Resources\PersonnelEducation;

use App\Filament\Resources\PersonnelEducation\Pages\CreatePersonnelEducation;
use App\Filament\Resources\PersonnelEducation\Pages\EditPersonnelEducation;
use App\Filament\Resources\PersonnelEducation\Pages\ListPersonnelEducation;
use App\Filament\Resources\PersonnelEducation\Schemas\PersonnelEducationForm;
use App\Filament\Resources\PersonnelEducation\Tables\PersonnelEducationTable;
use App\Models\Resources\PersonnelEducation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonnelEducationResource extends Resource
{
    protected static ?string $model = PersonnelEducation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'CU Data Gateway';

    protected static ?string $navigationLabel = 'Personnel Education (DG0306)';

    public static function form(Schema $schema): Schema
    {
        return PersonnelEducationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonnelEducationTable::configure($table);
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
            'index' => ListPersonnelEducation::route('/'),
            'create' => CreatePersonnelEducation::route('/create'),
            'edit' => EditPersonnelEducation::route('/{record}/edit'),
        ];
    }
}
