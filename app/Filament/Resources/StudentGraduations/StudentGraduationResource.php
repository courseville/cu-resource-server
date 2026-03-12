<?php

namespace App\Filament\Resources\StudentGraduations;

use App\Filament\Resources\StudentGraduations\Pages\CreateStudentGraduation;
use App\Filament\Resources\StudentGraduations\Pages\EditStudentGraduation;
use App\Filament\Resources\StudentGraduations\Pages\ListStudentGraduations;
use App\Filament\Resources\StudentGraduations\Pages\ViewStudentGraduation;
use App\Filament\Resources\StudentGraduations\Schemas\StudentGraduationForm;
use App\Filament\Resources\StudentGraduations\Schemas\StudentGraduationInfolist;
use App\Filament\Resources\StudentGraduations\Tables\StudentGraduationsTable;
use App\Models\Resources\StudentGraduation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudentGraduationResource extends Resource
{
    protected static ?string $model = StudentGraduation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    public static function form(Schema $schema): Schema
    {
        return StudentGraduationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudentGraduationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentGraduationsTable::configure($table);
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
            'index' => ListStudentGraduations::route('/'),
            'create' => CreateStudentGraduation::route('/create'),
            'view' => ViewStudentGraduation::route('/{record}'),
            'edit' => EditStudentGraduation::route('/{record}/edit'),
        ];
    }
}
