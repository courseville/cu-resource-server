<?php

namespace App\Filament\Resources\CourseInstructors;

use App\Filament\Resources\CourseInstructors\Pages\CreateCourseInstructor;
use App\Filament\Resources\CourseInstructors\Pages\EditCourseInstructor;
use App\Filament\Resources\CourseInstructors\Pages\ListCourseInstructors;
use App\Filament\Resources\CourseInstructors\Pages\ViewCourseInstructor;
use App\Filament\Resources\CourseInstructors\Schemas\CourseInstructorForm;
use App\Filament\Resources\CourseInstructors\Schemas\CourseInstructorInfolist;
use App\Filament\Resources\CourseInstructors\Tables\CourseInstructorsTable;
use App\Models\Resources\CourseInstructor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CourseInstructorResource extends Resource
{
    protected static ?string $model = CourseInstructor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Resources';

    public static function form(Schema $schema): Schema
    {
        return CourseInstructorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CourseInstructorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourseInstructorsTable::configure($table);
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
            'index' => ListCourseInstructors::route('/'),
            'create' => CreateCourseInstructor::route('/create'),
            'view' => ViewCourseInstructor::route('/{record}'),
            'edit' => EditCourseInstructor::route('/{record}/edit'),
        ];
    }
}
