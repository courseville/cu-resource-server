<?php

namespace App\Filament\Resources\StudentCurriculums;

use App\Filament\Resources\StudentCurriculums\Pages\CreateStudentCurriculum;
use App\Filament\Resources\StudentCurriculums\Pages\EditStudentCurriculum;
use App\Filament\Resources\StudentCurriculums\Pages\ListStudentCurriculums;
use App\Filament\Resources\StudentCurriculums\Pages\ViewStudentCurriculum;
use App\Filament\Resources\StudentCurriculums\Schemas\StudentCurriculumForm;
use App\Filament\Resources\StudentCurriculums\Schemas\StudentCurriculumInfolist;
use App\Filament\Resources\StudentCurriculums\Tables\StudentCurriculumsTable;
use App\Models\Resources\StudentCurriculum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudentCurriculumResource extends Resource
{
    protected static ?string $model = StudentCurriculum::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    public static function form(Schema $schema): Schema
    {
        return StudentCurriculumForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudentCurriculumInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentCurriculumsTable::configure($table);
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
            'index' => ListStudentCurriculums::route('/'),
            'create' => CreateStudentCurriculum::route('/create'),
            'view' => ViewStudentCurriculum::route('/{record}'),
            'edit' => EditStudentCurriculum::route('/{record}/edit'),
        ];
    }
}
