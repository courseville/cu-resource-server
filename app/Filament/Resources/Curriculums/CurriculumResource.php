<?php

namespace App\Filament\Resources\Curriculums;

use App\Filament\Resources\Curriculums\Pages\CreateCurriculum;
use App\Filament\Resources\Curriculums\Pages\EditCurriculum;
use App\Filament\Resources\Curriculums\Pages\ListCurriculums;
use App\Filament\Resources\Curriculums\Pages\ViewCurriculum;
use App\Filament\Resources\Curriculums\Schemas\CurriculumForm;
use App\Filament\Resources\Curriculums\Schemas\CurriculumInfolist;
use App\Filament\Resources\Curriculums\Tables\CurriculumsTable;
use App\Models\Resources\Curriculum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CurriculumResource extends Resource
{
    protected static ?string $model = Curriculum::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    public static function form(Schema $schema): Schema
    {
        return CurriculumForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CurriculumInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurriculumsTable::configure($table);
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
            'index' => ListCurriculums::route('/'),
            'create' => CreateCurriculum::route('/create'),
            'view' => ViewCurriculum::route('/{record}'),
            'edit' => EditCurriculum::route('/{record}/edit'),
        ];
    }
}
