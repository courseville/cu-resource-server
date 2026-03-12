<?php

namespace App\Filament\Resources\AcademicPrograms;

use App\Filament\Resources\AcademicPrograms\Pages\CreateAcademicProgram;
use App\Filament\Resources\AcademicPrograms\Pages\EditAcademicProgram;
use App\Filament\Resources\AcademicPrograms\Pages\ListAcademicPrograms;
use App\Filament\Resources\AcademicPrograms\Pages\ViewAcademicProgram;
use App\Filament\Resources\AcademicPrograms\Schemas\AcademicProgramForm;
use App\Filament\Resources\AcademicPrograms\Schemas\AcademicProgramInfolist;
use App\Filament\Resources\AcademicPrograms\Tables\AcademicProgramsTable;
use App\Models\Resources\AcademicProgram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AcademicProgramResource extends Resource
{
    protected static ?string $model = AcademicProgram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    public static function form(Schema $schema): Schema
    {
        return AcademicProgramForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AcademicProgramInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicProgramsTable::configure($table);
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
            'index' => ListAcademicPrograms::route('/'),
            'create' => CreateAcademicProgram::route('/create'),
            'view' => ViewAcademicProgram::route('/{record}'),
            'edit' => EditAcademicProgram::route('/{record}/edit'),
        ];
    }
}
